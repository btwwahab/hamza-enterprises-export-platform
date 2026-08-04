/* Live currency conversion for vehicle prices.
   Base data is stored in USD; rates are fetched from a free public API
   and cached in localStorage for 12 hours. Falls back to approximate
   static rates if the network request fails. */

const HamzaCurrency = (function () {
  const CACHE_KEY = 'he_fx_rates';
  const CACHE_HOURS = 12;
  const API_URL = 'https://open.er-api.com/v6/latest/USD';

  // Approximate rates, only used if the live API request fails — the live
  // API (open.er-api.com) already covers every currency listed below.
  const FALLBACK_RATES = {
    USD: 1, EUR: 0.92, GBP: 0.79, CHF: 0.88, NOK: 10.6, SEK: 10.4, DKK: 6.9,
    PLN: 4.0, CZK: 22.8, HUF: 360, RON: 4.6, BGN: 1.8, RSD: 108, UAH: 41,
    RUB: 92, BYN: 3.3, MDL: 17.8, ALL: 92, MKD: 56.5, BAM: 1.8, ISK: 138,
    TRY: 34, GEL: 2.7, AMD: 388, AZN: 1.7,
    CAD: 1.36, MXN: 17.1, BRL: 5.1, ARS: 980, CLP: 950, COP: 4100, PEN: 3.75,
    UYU: 40, BOB: 6.9, PYG: 7450, VES: 36.5, GTQ: 7.7, HNL: 24.7, NIO: 36.8,
    CRC: 520, PAB: 1, DOP: 59, JMD: 156, TTD: 6.8, BSD: 1, BBD: 2, BZD: 2,
    GYD: 209, SRD: 32, HTG: 132, CUP: 24,
    AED: 3.67, SAR: 3.75, QAR: 3.64, OMR: 0.385, BHD: 0.376, KWD: 0.307,
    ILS: 3.7, JOD: 0.709, LBP: 89500, IQD: 1310, IRR: 42000, YER: 250, SYP: 13000,
    INR: 83.5, PKR: 278, BDT: 118, LKR: 305, NPR: 133.6, AFN: 70,
    CNY: 7.24, JPY: 152, KRW: 1350, HKD: 7.82, TWD: 32.3, SGD: 1.35,
    MYR: 4.7, THB: 36.5, IDR: 15900, PHP: 57.8, VND: 25400, MMK: 2100,
    KHR: 4080, LAK: 21600, MNT: 3450, BND: 1.35, MOP: 8.05,
    KZT: 445, UZS: 12700, TJS: 10.9, KGS: 87, TMT: 3.5,
    KES: 129, NGN: 1550, ZAR: 18.5, EGP: 49, TZS: 2600, UGX: 3750, GHS: 15.5,
    MAD: 10.0, DZD: 134.5, TND: 3.1, LYD: 4.85, ETB: 57.5, XOF: 605, XAF: 605,
    ZMW: 26.5, MWK: 1740, MZN: 63.9, AOA: 890, BWP: 13.6, NAD: 18.5, SZL: 18.5,
    LSL: 18.5, RWF: 1330, BIF: 2870, SOS: 571, SDG: 601, SSP: 1300, ERN: 15,
    DJF: 178, GNF: 8600, SLL: 22500, LRD: 190, GMD: 68, CVE: 101, STN: 22.4,
    SCR: 13.6, MUR: 46.5, MGA: 4550, KMF: 452,
    AUD: 1.52, NZD: 1.64, FJD: 2.27, PGK: 3.9, WST: 2.7, TOP: 2.35, VUV: 119, SBD: 8.5,
  };

  const CURRENCIES = [
    // North America
    { code: 'USD', flag: '🇺🇸', label: 'USD — US Dollar' },
    { code: 'CAD', flag: '🇨🇦', label: 'CAD — Canadian Dollar' },
    { code: 'MXN', flag: '🇲🇽', label: 'MXN — Mexican Peso' },
    // South & Central America / Caribbean
    { code: 'BRL', flag: '🇧🇷', label: 'BRL — Brazilian Real' },
    { code: 'ARS', flag: '🇦🇷', label: 'ARS — Argentine Peso' },
    { code: 'CLP', flag: '🇨🇱', label: 'CLP — Chilean Peso' },
    { code: 'COP', flag: '🇨🇴', label: 'COP — Colombian Peso' },
    { code: 'PEN', flag: '🇵🇪', label: 'PEN — Peruvian Sol' },
    { code: 'UYU', flag: '🇺🇾', label: 'UYU — Uruguayan Peso' },
    { code: 'BOB', flag: '🇧🇴', label: 'BOB — Bolivian Boliviano' },
    { code: 'PYG', flag: '🇵🇾', label: 'PYG — Paraguayan Guarani' },
    { code: 'VES', flag: '🇻🇪', label: 'VES — Venezuelan Bolivar' },
    { code: 'GTQ', flag: '🇬🇹', label: 'GTQ — Guatemalan Quetzal' },
    { code: 'HNL', flag: '🇭🇳', label: 'HNL — Honduran Lempira' },
    { code: 'NIO', flag: '🇳🇮', label: 'NIO — Nicaraguan Cordoba' },
    { code: 'CRC', flag: '🇨🇷', label: 'CRC — Costa Rican Colon' },
    { code: 'PAB', flag: '🇵🇦', label: 'PAB — Panamanian Balboa' },
    { code: 'DOP', flag: '🇩🇴', label: 'DOP — Dominican Peso' },
    { code: 'JMD', flag: '🇯🇲', label: 'JMD — Jamaican Dollar' },
    { code: 'TTD', flag: '🇹🇹', label: 'TTD — Trinidad & Tobago Dollar' },
    { code: 'BSD', flag: '🇧🇸', label: 'BSD — Bahamian Dollar' },
    { code: 'BBD', flag: '🇧🇧', label: 'BBD — Barbadian Dollar' },
    { code: 'BZD', flag: '🇧🇿', label: 'BZD — Belize Dollar' },
    { code: 'GYD', flag: '🇬🇾', label: 'GYD — Guyanese Dollar' },
    { code: 'SRD', flag: '🇸🇷', label: 'SRD — Surinamese Dollar' },
    { code: 'HTG', flag: '🇭🇹', label: 'HTG — Haitian Gourde' },
    { code: 'CUP', flag: '🇨🇺', label: 'CUP — Cuban Peso' },
    // Europe
    { code: 'EUR', flag: '🇪🇺', label: 'EUR — Euro' },
    { code: 'GBP', flag: '🇬🇧', label: 'GBP — British Pound' },
    { code: 'CHF', flag: '🇨🇭', label: 'CHF — Swiss Franc' },
    { code: 'NOK', flag: '🇳🇴', label: 'NOK — Norwegian Krone' },
    { code: 'SEK', flag: '🇸🇪', label: 'SEK — Swedish Krona' },
    { code: 'DKK', flag: '🇩🇰', label: 'DKK — Danish Krone' },
    { code: 'PLN', flag: '🇵🇱', label: 'PLN — Polish Zloty' },
    { code: 'CZK', flag: '🇨🇿', label: 'CZK — Czech Koruna' },
    { code: 'HUF', flag: '🇭🇺', label: 'HUF — Hungarian Forint' },
    { code: 'RON', flag: '🇷🇴', label: 'RON — Romanian Leu' },
    { code: 'BGN', flag: '🇧🇬', label: 'BGN — Bulgarian Lev' },
    { code: 'RSD', flag: '🇷🇸', label: 'RSD — Serbian Dinar' },
    { code: 'UAH', flag: '🇺🇦', label: 'UAH — Ukrainian Hryvnia' },
    { code: 'RUB', flag: '🇷🇺', label: 'RUB — Russian Ruble' },
    { code: 'BYN', flag: '🇧🇾', label: 'BYN — Belarusian Ruble' },
    { code: 'MDL', flag: '🇲🇩', label: 'MDL — Moldovan Leu' },
    { code: 'ALL', flag: '🇦🇱', label: 'ALL — Albanian Lek' },
    { code: 'MKD', flag: '🇲🇰', label: 'MKD — Macedonian Denar' },
    { code: 'BAM', flag: '🇧🇦', label: 'BAM — Bosnia-Herzegovina Mark' },
    { code: 'ISK', flag: '🇮🇸', label: 'ISK — Icelandic Krona' },
    { code: 'TRY', flag: '🇹🇷', label: 'TRY — Turkish Lira' },
    { code: 'GEL', flag: '🇬🇪', label: 'GEL — Georgian Lari' },
    { code: 'AMD', flag: '🇦🇲', label: 'AMD — Armenian Dram' },
    { code: 'AZN', flag: '🇦🇿', label: 'AZN — Azerbaijani Manat' },
    // Middle East
    { code: 'AED', flag: '🇦🇪', label: 'AED — UAE Dirham' },
    { code: 'SAR', flag: '🇸🇦', label: 'SAR — Saudi Riyal' },
    { code: 'QAR', flag: '🇶🇦', label: 'QAR — Qatari Riyal' },
    { code: 'OMR', flag: '🇴🇲', label: 'OMR — Omani Rial' },
    { code: 'BHD', flag: '🇧🇭', label: 'BHD — Bahraini Dinar' },
    { code: 'KWD', flag: '🇰🇼', label: 'KWD — Kuwaiti Dinar' },
    { code: 'ILS', flag: '🇮🇱', label: 'ILS — Israeli Shekel' },
    { code: 'JOD', flag: '🇯🇴', label: 'JOD — Jordanian Dinar' },
    { code: 'LBP', flag: '🇱🇧', label: 'LBP — Lebanese Pound' },
    { code: 'IQD', flag: '🇮🇶', label: 'IQD — Iraqi Dinar' },
    { code: 'IRR', flag: '🇮🇷', label: 'IRR — Iranian Rial' },
    { code: 'YER', flag: '🇾🇪', label: 'YER — Yemeni Rial' },
    { code: 'SYP', flag: '🇸🇾', label: 'SYP — Syrian Pound' },
    // South & Central Asia
    { code: 'INR', flag: '🇮🇳', label: 'INR — Indian Rupee' },
    { code: 'PKR', flag: '🇵🇰', label: 'PKR — Pakistani Rupee' },
    { code: 'BDT', flag: '🇧🇩', label: 'BDT — Bangladeshi Taka' },
    { code: 'LKR', flag: '🇱🇰', label: 'LKR — Sri Lankan Rupee' },
    { code: 'NPR', flag: '🇳🇵', label: 'NPR — Nepalese Rupee' },
    { code: 'AFN', flag: '🇦🇫', label: 'AFN — Afghan Afghani' },
    { code: 'KZT', flag: '🇰🇿', label: 'KZT — Kazakhstani Tenge' },
    { code: 'UZS', flag: '🇺🇿', label: 'UZS — Uzbekistani Som' },
    { code: 'TJS', flag: '🇹🇯', label: 'TJS — Tajikistani Somoni' },
    { code: 'KGS', flag: '🇰🇬', label: 'KGS — Kyrgystani Som' },
    { code: 'TMT', flag: '🇹🇲', label: 'TMT — Turkmenistani Manat' },
    // East & Southeast Asia
    { code: 'CNY', flag: '🇨🇳', label: 'CNY — Chinese Yuan' },
    { code: 'JPY', flag: '🇯🇵', label: 'JPY — Japanese Yen' },
    { code: 'KRW', flag: '🇰🇷', label: 'KRW — South Korean Won' },
    { code: 'HKD', flag: '🇭🇰', label: 'HKD — Hong Kong Dollar' },
    { code: 'TWD', flag: '🇹🇼', label: 'TWD — Taiwan Dollar' },
    { code: 'SGD', flag: '🇸🇬', label: 'SGD — Singapore Dollar' },
    { code: 'MYR', flag: '🇲🇾', label: 'MYR — Malaysian Ringgit' },
    { code: 'THB', flag: '🇹🇭', label: 'THB — Thai Baht' },
    { code: 'IDR', flag: '🇮🇩', label: 'IDR — Indonesian Rupiah' },
    { code: 'PHP', flag: '🇵🇭', label: 'PHP — Philippine Peso' },
    { code: 'VND', flag: '🇻🇳', label: 'VND — Vietnamese Dong' },
    { code: 'MMK', flag: '🇲🇲', label: 'MMK — Myanmar Kyat' },
    { code: 'KHR', flag: '🇰🇭', label: 'KHR — Cambodian Riel' },
    { code: 'LAK', flag: '🇱🇦', label: 'LAK — Lao Kip' },
    { code: 'MNT', flag: '🇲🇳', label: 'MNT — Mongolian Tugrik' },
    { code: 'BND', flag: '🇧🇳', label: 'BND — Brunei Dollar' },
    { code: 'MOP', flag: '🇲🇴', label: 'MOP — Macanese Pataca' },
    // Africa
    { code: 'KES', flag: '🇰🇪', label: 'KES — Kenyan Shilling' },
    { code: 'NGN', flag: '🇳🇬', label: 'NGN — Nigerian Naira' },
    { code: 'ZAR', flag: '🇿🇦', label: 'ZAR — South African Rand' },
    { code: 'EGP', flag: '🇪🇬', label: 'EGP — Egyptian Pound' },
    { code: 'TZS', flag: '🇹🇿', label: 'TZS — Tanzanian Shilling' },
    { code: 'UGX', flag: '🇺🇬', label: 'UGX — Ugandan Shilling' },
    { code: 'GHS', flag: '🇬🇭', label: 'GHS — Ghanaian Cedi' },
    { code: 'MAD', flag: '🇲🇦', label: 'MAD — Moroccan Dirham' },
    { code: 'DZD', flag: '🇩🇿', label: 'DZD — Algerian Dinar' },
    { code: 'TND', flag: '🇹🇳', label: 'TND — Tunisian Dinar' },
    { code: 'LYD', flag: '🇱🇾', label: 'LYD — Libyan Dinar' },
    { code: 'ETB', flag: '🇪🇹', label: 'ETB — Ethiopian Birr' },
    { code: 'XOF', flag: '🇸🇳', label: 'XOF — West African CFA Franc' },
    { code: 'XAF', flag: '🇨🇲', label: 'XAF — Central African CFA Franc' },
    { code: 'ZMW', flag: '🇿🇲', label: 'ZMW — Zambian Kwacha' },
    { code: 'MWK', flag: '🇲🇼', label: 'MWK — Malawian Kwacha' },
    { code: 'MZN', flag: '🇲🇿', label: 'MZN — Mozambican Metical' },
    { code: 'AOA', flag: '🇦🇴', label: 'AOA — Angolan Kwanza' },
    { code: 'BWP', flag: '🇧🇼', label: 'BWP — Botswana Pula' },
    { code: 'NAD', flag: '🇳🇦', label: 'NAD — Namibian Dollar' },
    { code: 'SZL', flag: '🇸🇿', label: 'SZL — Eswatini Lilangeni' },
    { code: 'LSL', flag: '🇱🇸', label: 'LSL — Lesotho Loti' },
    { code: 'RWF', flag: '🇷🇼', label: 'RWF — Rwandan Franc' },
    { code: 'BIF', flag: '🇧🇮', label: 'BIF — Burundian Franc' },
    { code: 'SOS', flag: '🇸🇴', label: 'SOS — Somali Shilling' },
    { code: 'SDG', flag: '🇸🇩', label: 'SDG — Sudanese Pound' },
    { code: 'SSP', flag: '🇸🇸', label: 'SSP — South Sudanese Pound' },
    { code: 'ERN', flag: '🇪🇷', label: 'ERN — Eritrean Nakfa' },
    { code: 'DJF', flag: '🇩🇯', label: 'DJF — Djiboutian Franc' },
    { code: 'GNF', flag: '🇬🇳', label: 'GNF — Guinean Franc' },
    { code: 'SLL', flag: '🇸🇱', label: 'SLL — Sierra Leonean Leone' },
    { code: 'LRD', flag: '🇱🇷', label: 'LRD — Liberian Dollar' },
    { code: 'GMD', flag: '🇬🇲', label: 'GMD — Gambian Dalasi' },
    { code: 'CVE', flag: '🇨🇻', label: 'CVE — Cape Verdean Escudo' },
    { code: 'STN', flag: '🇸🇹', label: 'STN — Sao Tome & Principe Dobra' },
    { code: 'SCR', flag: '🇸🇨', label: 'SCR — Seychellois Rupee' },
    { code: 'MUR', flag: '🇲🇺', label: 'MUR — Mauritian Rupee' },
    { code: 'MGA', flag: '🇲🇬', label: 'MGA — Malagasy Ariary' },
    { code: 'KMF', flag: '🇰🇲', label: 'KMF — Comorian Franc' },
    // Oceania
    { code: 'AUD', flag: '🇦🇺', label: 'AUD — Australian Dollar' },
    { code: 'NZD', flag: '🇳🇿', label: 'NZD — New Zealand Dollar' },
    { code: 'FJD', flag: '🇫🇯', label: 'FJD — Fijian Dollar' },
    { code: 'PGK', flag: '🇵🇬', label: 'PGK — Papua New Guinean Kina' },
    { code: 'WST', flag: '🇼🇸', label: 'WST — Samoan Tala' },
    { code: 'TOP', flag: '🇹🇴', label: 'TOP — Tongan Paʻanga' },
    { code: 'VUV', flag: '🇻🇺', label: 'VUV — Vanuatu Vatu' },
    { code: 'SBD', flag: '🇸🇧', label: 'SBD — Solomon Islands Dollar' },
  ];

  let ratesPromise = null;

  function readCache() {
    try {
      const raw = localStorage.getItem(CACHE_KEY);
      if (!raw) return null;
      const data = JSON.parse(raw);
      const ageHours = (Date.now() - data.fetchedAt) / 3600000;
      if (ageHours > CACHE_HOURS) return null;
      return data.rates;
    } catch (e) {
      return null;
    }
  }

  function writeCache(rates) {
    try {
      localStorage.setItem(CACHE_KEY, JSON.stringify({ rates, fetchedAt: Date.now() }));
    } catch (e) { /* localStorage unavailable, skip caching */ }
  }

  function getRates() {
    if (ratesPromise) return ratesPromise;

    const cached = readCache();
    if (cached) {
      ratesPromise = Promise.resolve({ rates: cached, live: true });
      return ratesPromise;
    }

    ratesPromise = fetch(API_URL)
      .then(res => {
        if (!res.ok) throw new Error('bad response');
        return res.json();
      })
      .then(data => {
        if (!data || !data.rates) throw new Error('no rates');
        writeCache(data.rates);
        return { rates: data.rates, live: true };
      })
      .catch(() => ({ rates: FALLBACK_RATES, live: false }));

    return ratesPromise;
  }

  function format(amountUSD, currencyCode, rates) {
    const rate = rates[currencyCode] || FALLBACK_RATES[currencyCode] || 1;
    const converted = amountUSD * rate;
    try {
      return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: currencyCode,
        maximumFractionDigits: converted >= 1000 ? 0 : 2,
      }).format(converted);
    } catch (e) {
      return `${currencyCode} ${Math.round(converted).toLocaleString()}`;
    }
  }

  // Site-wide selected currency — persisted so the choice made on any page
  // (navbar or a detail page) applies everywhere else too.
  const SELECTED_KEY = 'he_currency';
  const CHANGE_EVENT = 'hamza:currencychange';

  function getSelectedCode() {
    try {
      const stored = localStorage.getItem(SELECTED_KEY);
      if (stored && CURRENCIES.some(c => c.code === stored)) return stored;
    } catch (e) { /* localStorage unavailable */ }
    return 'USD';
  }

  function setSelectedCode(code) {
    if (!CURRENCIES.some(c => c.code === code)) return;
    try { localStorage.setItem(SELECTED_KEY, code); } catch (e) { /* ignore */ }
    window.dispatchEvent(new CustomEvent(CHANGE_EVENT, { detail: { code } }));
  }

  function onChange(callback) {
    window.addEventListener(CHANGE_EVENT, e => callback(e.detail.code));
  }

  return { getRates, format, CURRENCIES, getSelectedCode, setSelectedCode, onChange, CHANGE_EVENT };
})();

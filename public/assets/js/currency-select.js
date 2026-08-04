/* currency-select.js — wires every .currency-select element (navbar + detail
   pages) up as a searchable Select2 dropdown with flag icons, and keeps them
   all in sync site-wide via HamzaCurrency's persisted selection + change event. */
(function () {
  function populate($select) {
    const options = HamzaCurrency.CURRENCIES.map(c =>
      `<option value="${c.code}" data-flag="${c.flag}">${c.label}</option>`
    ).join('');
    $select.html(options);
  }

  function formatOption(state) {
    if (!state.id) return state.text;
    const flag = $(state.element).data('flag') || '';
    return $(`<span><span class="currency-flag">${flag}</span>${state.text}</span>`);
  }

  // The navbar shows only flag + code once a currency is picked (no room
  // for the full name there); the dropdown list itself still shows full
  // names everywhere so searching stays clear.
  function formatCompactSelection(state) {
    if (!state.id) return state.text;
    const flag = $(state.element).data('flag') || '';
    return $(`<span><span class="currency-flag">${flag}</span><span class="currency-code-text">${state.id}</span></span>`);
  }

  let syncBound = false;

  // Re-runnable: call again after any page dynamically injects a new
  // .currency-select element (e.g. car-detail.js/machinery-detail.js build
  // their price card after the initial DOMContentLoaded pass).
  function init() {
    if (typeof HamzaCurrency === 'undefined') return;

    const $selects = $('.currency-select').not('.select2-hidden-accessible');
    if ($selects.length) {
      $selects.each(function () {
        const $el = $(this);
        const compact = $el.data('compact');
        populate($el);
        $el.val(HamzaCurrency.getSelectedCode());
        $el.select2({
          width: $el.data('width') || 'resolve',
          minimumResultsForSearch: 0,
          templateResult: formatOption,
          templateSelection: compact ? formatCompactSelection : formatOption,
          dropdownAutoWidth: true,
          escapeMarkup: markup => markup,
        });
      });

      $selects.on('select2:select', function (e) {
        HamzaCurrency.setSelectedCode(e.params.data.id);
      });
    }

    if (!syncBound) {
      syncBound = true;
      HamzaCurrency.onChange(function (code) {
        $('.currency-select').each(function () {
          const $el = $(this);
          if ($el.val() !== code) {
            $el.val(code).trigger('change.select2');
          }
        });
      });
    }
  }

  window.HamzaCurrencySelect = { init };
  $(init);
})();

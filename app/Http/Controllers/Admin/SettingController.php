<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = Setting::current();

        return view('admin.settings', compact('settings'));
    }

    public function updateHero(Request $request)
    {
        $data = $request->validate([
            'hero_badge' => ['required', 'string', 'max:150'],
            'hero_headline' => ['required', 'string', 'max:255'],
            'hero_subheadline' => ['required', 'string', 'max:500'],
            'stat_vehicles' => ['required', 'integer', 'min:0'],
            'stat_dealers' => ['required', 'integer', 'min:0'],
            'stat_countries' => ['required', 'integer', 'min:0'],
        ]);

        Setting::current()->update($data);

        return redirect()->route('admin.settings')->with('status', 'Hero settings saved.');
    }

    public function updateCompany(Request $request)
    {
        $data = $request->validate([
            'company_name' => ['required', 'string', 'max:150'],
            'email' => ['nullable', 'email', 'max:150'],
            'address_korea' => ['required', 'string', 'max:255'],
            'hamza_phone' => ['required', 'string', 'max:30'],
            'fatima_phone' => ['required', 'string', 'max:30'],
            'social_facebook' => ['nullable', 'url', 'max:255'],
            'social_linkedin' => ['nullable', 'url', 'max:255'],
            'social_whatsapp' => ['nullable', 'url', 'max:255'],
            'social_youtube' => ['nullable', 'url', 'max:255'],
        ]);

        Setting::current()->update($data);

        return redirect()->route('admin.settings')->with('status', 'Company information saved.');
    }

    public function updateShowrooms(Request $request)
    {
        $rules = [];
        foreach ([1, 2] as $i) {
            $rules["showroom{$i}_tag"] = ['required', 'string', 'max:50'];
            $rules["showroom{$i}_name"] = ['required', 'string', 'max:150'];
            $rules["showroom{$i}_address"] = ['required', 'string', 'max:255'];
            $rules["showroom{$i}_phone"] = ['required', 'string', 'max:30'];
            $rules["showroom{$i}_whatsapp"] = ['required', 'string', 'max:30'];
            $rules["showroom{$i}_maps_url"] = ['nullable', 'string', 'max:500'];
        }

        Setting::current()->update($request->validate($rules));

        return redirect()->route('admin.settings')->with('status', 'Showrooms & yards saved.');
    }

    public function updateLeadership(Request $request)
    {
        $rules = [];
        foreach ([1, 2] as $i) {
            $rules["leader{$i}_tag"] = ['required', 'string', 'max:100'];
            $rules["leader{$i}_name"] = ['required', 'string', 'max:150'];
            $rules["leader{$i}_role"] = ['required', 'string', 'max:100'];
            $rules["leader{$i}_phone"] = ['required', 'string', 'max:30'];
            $rules["leader{$i}_whatsapp"] = ['required', 'string', 'max:30'];

            $rules["bank{$i}_tag"] = ['required', 'string', 'max:100'];
            $rules["bank{$i}_name"] = ['required', 'string', 'max:150'];
            foreach ([1, 2, 3, 4] as $r) {
                $rules["bank{$i}_row{$r}_label"] = ['nullable', 'string', 'max:50'];
                $rules["bank{$i}_row{$r}_value"] = ['nullable', 'string', 'max:100'];
            }
        }

        Setting::current()->update($request->validate($rules));

        return redirect()->route('admin.settings')->with('status', 'Leadership & payments saved.');
    }
}

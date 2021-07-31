<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\NewModel;
use App\Models\SettingModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class SettingController extends Controller
{

    private $settings;
    public function __construct(SettingModel $settings)
    {
        $this->settings = $settings;
    }

    public function index() {
        $settings = $this->settings->latest()->paginate(5);

        return view('backend.contents.settings.index', compact('settings'));
    }

    public function create() {
        return view('backend.contents.settings.create');
    }

    public function edit($id){
        $setting = $this->settings->find($id);

        return view('backend.contents.settings.edit', compact('setting'));
    }

    public function store(Request $request) {

        $validate_pro =[
            'config_key' => 'required',
            'config_value' => 'required',
        ];
        $error_messages = [
            'required' => ':attribute is required',
            'numeric' => ':attribute phải là số',
            'unique' => ':attribute đã tồn tại'
        ];
        $this->validate($request, $validate_pro, $error_messages);

        $this->settings->create([
           'config_key' => $request->config_key,
           'config_value' => $request->config_value,
            'type' => $request->type
        ]);
        return redirect()->route('settings.index')->with('success', 'New setting added successfully');
    }
    public function update(Request $request, $id) {

        $validate_pro =[
            'config_key' => 'required',
            'config_value' => 'required',
        ];
        $error_messages = [
            'required' => ':attribute is required',
            'numeric' => ':attribute phải là số',
            'unique' => ':attribute đã tồn tại'
        ];
        $this->validate($request, $validate_pro, $error_messages);

        $this->settings->find($id)->update([
            'config_key' => $request->config_key,
            'config_value' => $request->config_value
        ]);

        return redirect()->route('settings.index')->with('success', 'Setting updated successfully');

    }

    public function delete($id) {
        $this->settings->find($id)->delete();
        return redirect()->route('settings.index')->with('success', 'Delete setting successfully');
    }
}

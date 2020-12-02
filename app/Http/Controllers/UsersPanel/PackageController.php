<?php

namespace App\Http\Controllers\UsersPanel;


use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Package;

class PackageController extends AppBaseController
{
    public function packages()
    {
        $packages = Package::with('feature')->get();
        return view('usersPanel.page.package.package', compact('packages'));
    }

    public function package($id)
    {
        $user = auth()->user();
        $user->update(['package_id'=>$id]);

        return back()->with(['alertStatus' => 'Successful subscription', 'icon' => 'success']);
    }
}

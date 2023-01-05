<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mockery\Exception;
use Auth;

class UserSettingsController extends Controller
{
    public function changeTheme(Request $request)
    {
        try{
            $details = Auth::user()->details;
            $details->theme =  $request->input('theme', 'classic');
            $details->push();

            $themeName = ucwords( $details->theme);
            return [ 'message' => "Theme changed successfully to '{$themeName}'."];
        }
        catch(Exception $e)
        {
            abort(503, 'Theme could not be changed');
        }
    }

    public function changeLocale($locale)
    {

        $langMap = [
            'en' => 'English',
            'sv_SE' => 'Swedish',
        ];

        // TODO: added $message and $error variables in the front.blade.php, but message isn't showing
        $viewData = [];
        try
        {
            \Session::put('locale', $locale);

                if($user = Auth::user()){
                    $details = $user->details;
                    $details->locale =  $locale;
                    $details->push();
                    $viewData['message'] = __("Language successfully changed to :language.", [$langMap[$locale]]);
                }
        }
        catch(\Exception $e)
        {
            \Session::forget('locale');
            $viewData['error'] = __("Language could not be successfully changed to :language.", [$langMap[$locale]]);
        }

        return redirect()->back()->with($viewData);
    }
}

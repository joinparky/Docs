<?php
namespace App\Providers;

use Form;
use Illuminate\Support\ServiceProvider;

class FormMacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Form::macro('makeRadio', function ($name, $data, $checked = null, $icon = null, $gule="&nbsp;") {
            $returnVal = "<div class=\"radio\">";
            foreach ($data as $k => $v) {
                $attrChecked = (!is_null($checked) && $k == $checked)  ? "checked=\"checked\"" : "";
                $returnVal .=  "<label class=\"".$name.$k."\">";
                $returnVal .=  "<input type=\"radio\" name=\"".$name."\" class=\"".$name."\" id=\"".$name.$k."\" value=\"".$k."\" ".$attrChecked." />";
                if ($icon) $returnVal .=  "<span class=\"".$icon."\" aria-hidden=\"true\"></span>";
                $returnVal .=  $v;
                $returnVal .=  "</label>".$gule;
                    //Form::radio($k, $v);
            }
            $returnVal .= "</div>";

            return $returnVal;
        });

        Form::macro('makeCheckbox', function ($name, $data, $checked = null, $icon = null, $gule="&nbsp;") {
            $returnVal = "<div class=\"checkbox\">";
            foreach ($data as $k => $v) {
                $attrChecked = (!empty($checked) && in_array($k, $checked))  ? "checked=\"checked\"" : "";
                $returnVal .=  "<label class=\"".$name.$k."\">";
                $returnVal .=  "<input type=\"checkbox\" name=\"".$name."[]\" class=\"".$name."\" id=\"".$name.$k."\" value=\"".$k."\" ".$attrChecked." />";
                $returnVal .=  $v;
                $returnVal .=  "</label>".$gule;
            }
            $returnVal .= "</div>";
            return $returnVal;
        });

        Form::macro('makeSelect', function ($name, $data, $selected = null, $class = null, $selectTitle = null, $optionTitle = null,$id = null) {

            $dispClass = (!is_null($class)) ? " class=\"".$class."\"": "";
            $dispId  = (!is_null($id)) ? $id: $name;

            $returnVal = "<select name=\"".$name."\" id=\"".$dispId."\" ".$dispClass." title=\"".$selectTitle."\">";
            if($optionTitle) $returnVal.="<option value=\"\">".$optionTitle."</option>\n";
            foreach ($data as $k => $v) {
                $attrSelected = (!is_null($selected) && $k == $selected)  ? "selected=\"selected\"" : "";
                $returnVal .= "<option value=\"".$k."\" ".$attrSelected.">".$v."</option>";
            }
            $returnVal .= "</select>";

            return $returnVal;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
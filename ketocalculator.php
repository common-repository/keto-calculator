<?php
/*
* Plugin Name: Keto Calculator
* Description: Keto Calculator is a simple calculator, which is used to measure your nutritional needs on a ketogenic diet. It helps users achieve their goal of healing, weight loss, performance and more.Use shortcode "[[trs_keto_calculator]]" anywhere on your page. <span>Based on <a href="https://github.com/ketodiet/keto-calculator">KetoDiet calculator</a></span>
* Version: 1.4
* Author: The Right Software
* Author URI: https://therightsw.com/plugin-development/
* Text Domain: trs_keto_calculator
* License: GPL v3.0
*/

function trs_trs_keto_calculator_init() {
    $plugin_rel_path = basename( dirname( __FILE__ ) ) . '/languages'; /* Relative to WP_PLUGIN_DIR */
    load_plugin_textdomain( 'trs_keto_calculator', false, $plugin_rel_path );
}
add_action('plugins_loaded', 'trs_trs_keto_calculator_init');
function trs_keto_calculator(){
    $qoutesKetstr = addslashes(__( 'Specify the amount of daily net carbs you\'d like to consume. Typically, 20-30 grams is recommended to start with.', 'keto-calculator' ));
    $Ketoutput='';
   $Ketoutput .= '<div id="ketoDietTRS">
        <div><span class="kdbFieldName">'.__( 'Units', 'keto-calculator' ).'</span>
            <div class="radioBlock">
                <select name="units">
                    <option value="0">'.__( 'Metric', 'keto-calculator' ).'</option>
                    <option value="1">'.__( 'US Customary', 'keto-calculator' ).'</option>
                </select>
            </div>
        </div><br>

        <div><span class="kdbFieldName">'.__( 'Gender', 'keto-calculator' ).'</span>
            <div class="radioBlock">
                <select name="gender" >
                    <option value="0">'.__( 'Female', 'keto-calculator' ).'</option>
                    <option value="1">'.__( 'Male', 'keto-calculator' ).'</option>
                </select>
            </div>
        </div><br>

        <p><span class="kdbFieldName">'.__( 'Age', 'keto-calculator' ).'</span><input type="text" name="age" value="35" style="border: 1px solid rgb(160, 160, 160);"><span>'.__( 'years', 'keto-calculator' ).'</span></p>

        <div class="calcMetric" style="display: none;">
            <p><span class="kdbFieldName">'.__( 'Weight', 'keto-calculator' ).'</span><input type="text" name="weightMetricKilos" value="80" style="border: 1px solid rgb(160, 160, 160);"><span>Kg</span></p>
            <p><span class="kdbFieldName">'.__( 'Height', 'keto-calculator' ).'</span><input type="text" name="heightMetricMeters" value="1.68" style="border: 1px solid rgb(160, 160, 160);"><span>'.__( 'meters (e.g. 1.76 meters = 176 cm)', 'keto-calculator' ).'</span></p>
        </div>

        <div class="calcUS" style="display: none;">
            <p><span class="kdbFieldName">'.__( 'Weight', 'keto-calculator' ).'</span><input type="text" name="weightUSPounds" value="176.4" style="border: 1px solid rgb(160, 160, 160);"><span>lbs</span></p>

            <p><span class="kdbFieldName">'.__( 'Height', 'keto-calculator' ).'</span><input type="text" name="heightUSFeet" value="5" style="border: 1px solid rgb(160, 160, 160);"><span>feet</span>
                <input type="text" name="heightUSInches" value="6.1" style="border: 1px solid rgb(160, 160, 160);"><span>inches</span></p>
        </div>

        <div class="calcImperial" style="display: block;">
            <p><span class="kdbFieldName">'.__( 'Weight', 'keto-calculator' ).'</span><input type="text" name="weightImperialStones" value="12" style="border: 1px solid rgb(160, 160, 160);"><span>stones</span>
                <input type="text" name="weightImperialPounds" value="8.4" style="border: 1px solid rgb(160, 160, 160);"><span>lbs</span></p>

            <p><span class="kdbFieldName">'.__( 'Height', 'keto-calculator' ).'</span><input type="text" name="heightImperialFeet" value="5" style="border: 1px solid rgb(160, 160, 160);"><span>feet</span>
                <input type="text" name="heightImperialInches" value="6.1" style="border: 1px solid rgb(160, 160, 160);"><span>inches</span></p>
        </div>

        <div><span class="kdbFieldName">'.__( 'Activity Level', 'keto-calculator' ).'</span>
            <div class="radioBlock">
                <select name="activity">
                    <option value="0">'.__( 'Sedentary', 'keto-calculator' ).'</option>
                    <option value="1">'.__( 'Lightly active', 'keto-calculator' ).'</option>
                    <option value="2">'.__( 'Moderately active', 'keto-calculator' ).'</option>
                    <option value="3">'.__( 'Very active', 'keto-calculator' ).'</option>
                    <option value="4">'.__( 'Athlete/Bodybuilder', 'keto-calculator' ).'</option>
                </select>
            </div>
        </div><br>

        <p><span class="kdbFieldName">'.__( 'Body fat', 'keto-calculator' ).'</span><input type="text" name="bodyfat" value="25" style="border: 1px solid rgb(160, 160, 160);"><span>%</span></p>

        <p><span class="kdbFieldName">'.__( 'Net carbs', 'keto-calculator' ).'</span><input type="text" name="netcarbs" value="25" style="border: 1px solid rgb(160, 160, 160);"><span>'.__('grams', 'keto-calculator' ).'</span></p>
        <p>'.$qoutesKetstr.'</p>';
        $Ketoutput .= '<div id="kdbResults">';
            $Ketoutput .= '<h2>'.__( 'Results', 'keto-calculator' ).'</h2>';
            $Ketoutput .= '<h3>'.__( 'Maintenance', 'keto-calculator' ).'</h3>';
           $Ketoutput .= ' <p>'.__( 'Maintenance level is the level at which your weight remains stable.', 'keto-calculator' ).'</p>';
            $Ketoutput .= '<div id="resultsMaintainWeight">
                <div class="kdbResultCard" id="resultsZeroDeficit"><div class="kdbMacroOverview"><div class="kdbMacroContent"><div class="kdbMacroContentLeft"><div class="kdbEnergyOverview"><table><tbody><tr><td class="kdbAttributeName">'.__( 'Your BMR is:', 'keto-calculator' ).'</td><td class="kdbAttributeValue">1536</td><td class="kdbAttributeUnits">'.__( 'kcal' ).'</td></tr><tr><td class="kdbAttributeName">'.__( 'Calories to consume', 'keto-calculator' ).':</td><td class="kdbAttributeValue">2027</td><td class="kdbAttributeUnits">'.__( 'kcal' ).'</td></tr><tr><td class="kdbAttributeName">'.__( 'Your fat intake should be:', 'keto-calculator' ).'</td><td class="kdbAttributeValue">184</td><td class="kdbAttributeUnits">grams</td></tr></tbody></table></div><div class="kdbMacroLegend"><table><tbody><tr><td colspan="2" class="kdbLegendName kdbNetCarbs">'.__( 'Net Carbs', 'keto-calculator' ).'</td><td colspan="2" class="kdbLegendName kdbProtein">'.__( 'Protein', 'keto-calculator' ).'</td><td colspan="2" class="kdbLegendName kdbFat">'.__( 'Fat', 'keto-calculator' ).'</td></tr><tr><td class="kdbLegendValue kdbNetCarbs">25</td><td class="kdbLegendUnits kdbNetCarbs">'.__( 'grams', 'keto-calculator' ).'</td><td class="kdbLegendValue kdbProtein">69</td><td class="kdbLegendUnits kdbProtein">'.__( 'grams', 'keto-calculator' ).'</td><td class="kdbLegendValue kdbFat">184</td><td class="kdbLegendUnits kdbFat">'.__( 'grams', 'keto-calculator' ).'</td></tr><tr><td class="kdbLegendValue kdbNetCarbs">100</td><td class="kdbLegendUnits kdbNetCarbs">'.__( 'kcal', 'keto-calculator' ).'</td><td class="kdbLegendValue kdbProtein">275</td><td class="kdbLegendUnits kdbProtein">'.__( 'kcal', 'keto-calculator' ).'</td><td class="kdbLegendValue kdbFat">1653</td><td class="kdbLegendUnits kdbFat">'.__( 'kcal', 'keto-calculator' ).'</td></tr><tr><td class="kdbLegendValue kdbNetCarbs">5</td><td class="kdbLegendUnits kdbNetCarbs">%</td><td class="kdbLegendValue kdbProtein">14</td><td class="kdbLegendUnits kdbProtein">%</td><td class="kdbLegendValue kdbFat">81</td><td class="kdbLegendUnits kdbFat">%</td></tr></tbody></table></div></div><div class="kdbMacroContentRight"><canvas class="kdbMacroChart" width="140" height="140" style="width: 140px; height: 140px;"></canvas></div></div></div></div>
            </div>';

           $Ketoutput .= ' <h3>'.__( 'Goal', 'keto-calculator' ).'</h3>
            <div class="radioBlock kdbResultGoal">
                <select name="kdbGoal">
                    <option value="0">'.__( 'Weight loss', 'keto-calculator' ).'</option>
                    <option value="1">'.__( 'Weight gain', 'keto-calculator' ).'</option>
                    <option value="2">'.__( 'Custom', 'keto-calculator' ).'</option>
                </select>
            </div>

            <div>
                <p class="kdbWarning kdbNOWEIGHTLOSSSUGGESTIONS" style="display: none;">'.__( 'Sorry, cannot offer any weight loss suggestions. Please use the Custom section for weight loss macro targets.', 'keto-calculator' ).'</p>
                <p class="kdbWarning kdbBODYFATTOOLOW" style="display: none;">'.__( 'Your body fat is too low. You should have a minimum of <span class="kdbEssentialFat">3</span>% body fat (essential fat you cannot lose). <em>It is not advisable for you to lose any more weight.', 'keto-calculator' ).'</em></p>
                <p class="kdbWarning kdbCARBSTOOHIGH" style="display: none;">'.__( 'Based on the amount of net carbs you specified, it would impossible to lose any weight. Please, reduce the amount of net carbs and try again.', 'keto-calculator' ).'</p>
            </div>

            <div id="resultsLosingWeight" style="display: block;">
                <p>'.__( 'Below is a range of calorie deficits to help you lose weight. For best results, it is recommended that you opt for a moderate calorie deficit of 10-20%.', 'keto-calculator' ).'</p>
                <div class="kdbResultCard" id="resultsSmallDeficit"><div class="kdbMacroOverview"><h4 class="kdbMacroChartTitle">'.__( 'Small calorie deficit', 'keto-calculator' ).' (11%)</h4><div class="kdbMacroContent"><div class="kdbMacroContentLeft"><div class="kdbEnergyOverview"><table><tbody><tr><td class="kdbAttributeName">'.__( 'Calories to consume', 'keto-calculator' ).':</td><td class="kdbAttributeValue">1804</td><td class="kdbAttributeUnits">kcal</td></tr><tr><td class="kdbAttributeName">'.__( 'Your fat intake should be', 'keto-calculator' ).':</td><td class="kdbAttributeValue">159</td><td class="kdbAttributeUnits">grams</td></tr></tbody></table></div><div class="kdbMacroLegend"><table><tbody><tr><td colspan="2" class="kdbLegendName kdbNetCarbs">Net Carbs</td><td colspan="2" class="kdbLegendName kdbProtein">'.__( 'Protein', 'keto-calculator' ).'</td><td colspan="2" class="kdbLegendName kdbFat">Fat</td></tr><tr><td class="kdbLegendValue kdbNetCarbs">25</td><td class="kdbLegendUnits kdbNetCarbs">grams</td><td class="kdbLegendValue kdbProtein">69</td><td class="kdbLegendUnits kdbProtein">grams</td><td class="kdbLegendValue kdbFat">159</td><td class="kdbLegendUnits kdbFat">grams</td></tr><tr><td class="kdbLegendValue kdbNetCarbs">100</td><td class="kdbLegendUnits kdbNetCarbs">kcal</td><td class="kdbLegendValue kdbProtein">275</td><td class="kdbLegendUnits kdbProtein">kcal</td><td class="kdbLegendValue kdbFat">1430</td><td class="kdbLegendUnits kdbFat">kcal</td></tr><tr><td class="kdbLegendValue kdbNetCarbs">6</td><td class="kdbLegendUnits kdbNetCarbs">%</td><td class="kdbLegendValue kdbProtein">15</td><td class="kdbLegendUnits kdbProtein">%</td><td class="kdbLegendValue kdbFat">79</td><td class="kdbLegendUnits kdbFat">%</td></tr></tbody></table></div></div><div class="kdbMacroContentRight"><canvas class="kdbMacroChart" width="140" height="140" style="width: 140px; height: 140px;"></canvas></div></div></div></div>
                <div class="kdbResultCard" id="resultsMediumDeficit"><div class="kdbMacroOverview"><h4 class="kdbMacroChartTitle">'.__( 'Moderate calorie deficit', 'keto-calculator' ).' (22%)</h4><div class="kdbMacroContent"><div class="kdbMacroContentLeft"><div class="kdbEnergyOverview"><table><tbody><tr><td class="kdbAttributeName">'.__( 'Calories to consume', 'keto-calculator' ).':</td><td class="kdbAttributeValue">1581</td><td class="kdbAttributeUnits">'.__( 'kcal', 'keto-calculator' ).'</td></tr><tr><td class="kdbAttributeName">'.__( 'Your fat intake should be', 'keto-calculator' ).':</td><td class="kdbAttributeValue">134</td><td class="kdbAttributeUnits">'.__( 'grams', 'keto-calculator' ).'</td></tr></tbody></table></div><div class="kdbMacroLegend"><table><tbody><tr><td colspan="2" class="kdbLegendName kdbNetCarbs">'.__( 'Net Carbs', 'keto-calculator' ).'</td><td colspan="2" class="kdbLegendName kdbProtein">'.__( 'Protein', 'keto-calculator' ).'</td><td colspan="2" class="kdbLegendName kdbFat">'.__( 'Fat', 'keto-calculator' ).'</td></tr><tr><td class="kdbLegendValue kdbNetCarbs">25</td><td class="kdbLegendUnits kdbNetCarbs">'.__( 'grams', 'keto-calculator' ).'</td><td class="kdbLegendValue kdbProtein">69</td><td class="kdbLegendUnits kdbProtein">grams</td><td class="kdbLegendValue kdbFat">134</td><td class="kdbLegendUnits kdbFat">'.__( 'grams', 'keto-calculator' ).'</td></tr><tr><td class="kdbLegendValue kdbNetCarbs">100</td><td class="kdbLegendUnits kdbNetCarbs">kcal</td><td class="kdbLegendValue kdbProtein">275</td><td class="kdbLegendUnits kdbProtein">'.__( 'kcal', 'keto-calculator' ).'</td><td class="kdbLegendValue kdbFat">1207</td><td class="kdbLegendUnits kdbFat">'.__( 'kcal', 'keto-calculator' ).'</td></tr><tr><td class="kdbLegendValue kdbNetCarbs">6</td><td class="kdbLegendUnits kdbNetCarbs">%</td><td class="kdbLegendValue kdbProtein">17</td><td class="kdbLegendUnits kdbProtein">%</td><td class="kdbLegendValue kdbFat">77</td><td class="kdbLegendUnits kdbFat">%</td></tr></tbody></table></div></div><div class="kdbMacroContentRight"><canvas class="kdbMacroChart" width="140" height="140" style="width: 140px; height: 140px;"></canvas></div></div></div></div>
                <div class="kdbResultCard" id="resultsLargeDeficit"><div class="kdbMacroOverview"><h4 class="kdbMacroChartTitle">'.__( 'Large calorie deficit', 'keto-calculator' ).' (33%)</h4><div class="kdbMacroContent"><div class="kdbMacroContentLeft"><div class="kdbEnergyOverview"><table><tbody><tr><td class="kdbAttributeName">'.__( 'Calories to consume', 'keto-calculator' ).':</td><td class="kdbAttributeValue">1358</td><td class="kdbAttributeUnits">'.__( 'kcal', 'keto-calculator' ).'</td></tr><tr><td class="kdbAttributeName">'.__( 'Your fat intake should be', 'keto-calculator' ).':</td><td class="kdbAttributeValue">109</td><td class="kdbAttributeUnits">'.__( 'grams', 'keto-calculator' ).'</td></tr></tbody></table></div><div class="kdbMacroLegend"><table><tbody><tr><td colspan="2" class="kdbLegendName kdbNetCarbs">'.__( 'Net Carbs', 'keto-calculator' ).'</td><td colspan="2" class="kdbLegendName kdbProtein">'.__( 'Protein', 'keto-calculator' ).'</td><td colspan="2" class="kdbLegendName kdbFat">'.__( 'Fat', 'keto-calculator' ).'</td></tr><tr><td class="kdbLegendValue kdbNetCarbs">25</td><td class="kdbLegendUnits kdbNetCarbs">'.__( 'grams', 'keto-calculator' ).'</td><td class="kdbLegendValue kdbProtein">69</td><td class="kdbLegendUnits kdbProtein">grams</td><td class="kdbLegendValue kdbFat">109</td><td class="kdbLegendUnits kdbFat">'.__( 'grams', 'keto-calculator' ).'</td></tr><tr><td class="kdbLegendValue kdbNetCarbs">100</td><td class="kdbLegendUnits kdbNetCarbs">'.__( 'kcal', 'keto-calculator' ).'</td><td class="kdbLegendValue kdbProtein">275</td><td class="kdbLegendUnits kdbProtein">'.__( 'kcal', 'keto-calculator' ).'</td><td class="kdbLegendValue kdbFat">984</td><td class="kdbLegendUnits kdbFat">'.__( 'kcal', 'keto-calculator' ).'</td></tr><tr><td class="kdbLegendValue kdbNetCarbs">7</td><td class="kdbLegendUnits kdbNetCarbs">%</td><td class="kdbLegendValue kdbProtein">20</td><td class="kdbLegendUnits kdbProtein">%</td><td class="kdbLegendValue kdbFat">73</td><td class="kdbLegendUnits kdbFat">%</td></tr></tbody></table></div></div><div class="kdbMacroContentRight"><canvas class="kdbMacroChart" width="140" height="140" style="width: 140px; height: 140px;"></canvas></div></div></div></div>
            </div>

            <div id="resultsGainingWeight" style="display: none;">
                <p>'.__( 'Below is a range of calorie surpluses to help you bulk up and gain muscle size. Keep in mind that you will need to add physical activity (weight training) in order to increase your muscle mass. For best results, it is recommended that you opt for a moderate calorie surplus of 10-20%.', 'keto-calculator' ).'</p>
                <div class="kdbResultCard" id="resultsSmallSurplus"><div class="kdbMacroOverview"><h4 class="kdbMacroChartTitle">'.__( 'Calorie surplus', 'keto-calculator' ).' (10%)</h4><div class="kdbMacroContent"><div class="kdbMacroContentLeft"><div class="kdbEnergyOverview"><table><tbody><tr><td class="kdbAttributeName">'.__( 'Calories to consume', 'keto-calculator' ).':</td><td class="kdbAttributeValue">2231</td><td class="kdbAttributeUnits">'.__( 'kcal', 'keto-calculator' ).'</td></tr><tr><td class="kdbAttributeName">'.__( 'Your fat intake should be', 'keto-calculator' ).':</td><td class="kdbAttributeValue">206</td><td class="kdbAttributeUnits">grams</td></tr></tbody></table></div><div class="kdbMacroLegend"><table><tbody><tr><td colspan="2" class="kdbLegendName kdbNetCarbs">'.__( 'Net Carbs', 'keto-calculator' ).'</td><td colspan="2" class="kdbLegendName kdbProtein">'.__( 'Protein', 'keto-calculator' ).'</td><td colspan="2" class="kdbLegendName kdbFat">'.__( 'Fat', 'keto-calculator' ).'</td></tr><tr><td class="kdbLegendValue kdbNetCarbs">25</td><td class="kdbLegendUnits kdbNetCarbs">'.__( 'grams', 'keto-calculator' ).'</td><td class="kdbLegendValue kdbProtein">69</td><td class="kdbLegendUnits kdbProtein">'.__( 'grams', 'keto-calculator' ).'</td><td class="kdbLegendValue kdbFat">206</td><td class="kdbLegendUnits kdbFat">'.__( 'grams', 'keto-calculator' ).'</td></tr><tr><td class="kdbLegendValue kdbNetCarbs">100</td><td class="kdbLegendUnits kdbNetCarbs">'.__( 'kcal', 'keto-calculator' ).'</td><td class="kdbLegendValue kdbProtein">275</td><td class="kdbLegendUnits kdbProtein">'.__( 'kcal', 'keto-calculator' ).'</td><td class="kdbLegendValue kdbFat">1856</td><td class="kdbLegendUnits kdbFat">'.__( 'kcal', 'keto-calculator' ).'</td></tr><tr><td class="kdbLegendValue kdbNetCarbs">4</td><td class="kdbLegendUnits kdbNetCarbs">%</td><td class="kdbLegendValue kdbProtein">12</td><td class="kdbLegendUnits kdbProtein">%</td><td class="kdbLegendValue kdbFat">84</td><td class="kdbLegendUnits kdbFat">%</td></tr></tbody></table></div></div><div class="kdbMacroContentRight"><canvas class="kdbMacroChart" width="140" height="140" style="width: 140px; height: 140px;"></canvas></div></div></div></div>
                <div class="kdbResultCard" id="resultsMediumSurplus"><div class="kdbMacroOverview"><h4 class="kdbMacroChartTitle">'.__( 'Calorie surplus', 'keto-calculator' ).' (15%)</h4><div class="kdbMacroContent"><div class="kdbMacroContentLeft"><div class="kdbEnergyOverview"><table><tbody><tr><td class="kdbAttributeName">'.__( 'Calories to consume', 'keto-calculator' ).':</td><td class="kdbAttributeValue">2332</td><td class="kdbAttributeUnits">'.__( 'kcal', 'keto-calculator' ).'</td></tr><tr><td class="kdbAttributeName">'.__( 'Your fat intake should be', 'keto-calculator' ).':</td><td class="kdbAttributeValue">218</td><td class="kdbAttributeUnits">grams</td></tr></tbody></table></div><div class="kdbMacroLegend"><table><tbody><tr><td colspan="2" class="kdbLegendName kdbNetCarbs">'.__( 'Net Carbs', 'keto-calculator' ).'</td><td colspan="2" class="kdbLegendName kdbProtein">'.__( 'Protein', 'keto-calculator' ).'</td><td colspan="2" class="kdbLegendName kdbFat">'.__( 'Fat', 'keto-calculator' ).'</td></tr><tr><td class="kdbLegendValue kdbNetCarbs">25</td><td class="kdbLegendUnits kdbNetCarbs">'.__( 'grams', 'keto-calculator' ).'</td><td class="kdbLegendValue kdbProtein">69</td><td class="kdbLegendUnits kdbProtein">'.__( 'grams', 'keto-calculator' ).'</td><td class="kdbLegendValue kdbFat">218</td><td class="kdbLegendUnits kdbFat">'.__( 'grams', 'keto-calculator' ).'</td></tr><tr><td class="kdbLegendValue kdbNetCarbs">100</td><td class="kdbLegendUnits kdbNetCarbs">'.__( 'kcal', 'keto-calculator' ).'</td><td class="kdbLegendValue kdbProtein">275</td><td class="kdbLegendUnits kdbProtein">'.__( 'kcal', 'keto-calculator' ).'</td><td class="kdbLegendValue kdbFat">1958</td><td class="kdbLegendUnits kdbFat">kcal</td></tr><tr><td class="kdbLegendValue kdbNetCarbs">4</td><td class="kdbLegendUnits kdbNetCarbs">%</td><td class="kdbLegendValue kdbProtein">12</td><td class="kdbLegendUnits kdbProtein">%</td><td class="kdbLegendValue kdbFat">84</td><td class="kdbLegendUnits kdbFat">%</td></tr></tbody></table></div></div><div class="kdbMacroContentRight"><canvas class="kdbMacroChart" width="140" height="140" style="width: 140px; height: 140px;"></canvas></div></div></div></div>
                <div class="kdbResultCard" id="resultsLargeSurplus"><div class="kdbMacroOverview"><h4 class="kdbMacroChartTitle">'.__( 'Calorie surplus', 'keto-calculator' ).' (20%)</h4><div class="kdbMacroContent"><div class="kdbMacroContentLeft"><div class="kdbEnergyOverview"><table><tbody><tr><td class="kdbAttributeName">'.__( 'Calories to consume', 'keto-calculator' ).':</td><td class="kdbAttributeValue">2434</td><td class="kdbAttributeUnits">'.__( 'kcal', 'keto-calculator' ).'</td></tr><tr><td class="kdbAttributeName">'.__( 'Your fat intake should be', 'keto-calculator' ).':</td><td class="kdbAttributeValue">229</td><td class="kdbAttributeUnits">'.__( 'grams', 'keto-calculator' ).'</td></tr></tbody></table></div><div class="kdbMacroLegend"><table><tbody><tr><td colspan="2" class="kdbLegendName kdbNetCarbs">Net Carbs</td><td colspan="2" class="kdbLegendName kdbProtein">'.__( 'Protein', 'keto-calculator' ).'</td><td colspan="2" class="kdbLegendName kdbFat">'.__( 'Fat', 'keto-calculator' ).'</td></tr><tr><td class="kdbLegendValue kdbNetCarbs">25</td><td class="kdbLegendUnits kdbNetCarbs">'.__( 'grams', 'keto-calculator' ).'</td><td class="kdbLegendValue kdbProtein">69</td><td class="kdbLegendUnits kdbProtein">'.__( 'grams', 'keto-calculator' ).'</td><td class="kdbLegendValue kdbFat">229</td><td class="kdbLegendUnits kdbFat">'.__( 'grams', 'keto-calculator' ).'</td></tr><tr><td class="kdbLegendValue kdbNetCarbs">100</td><td class="kdbLegendUnits kdbNetCarbs">kcal</td><td class="kdbLegendValue kdbProtein">275</td><td class="kdbLegendUnits kdbProtein">'.__( 'kcal', 'keto-calculator' ).'</td><td class="kdbLegendValue kdbFat">2059</td><td class="kdbLegendUnits kdbFat">'.__( 'kcal', 'keto-calculator' ).'</td></tr><tr><td class="kdbLegendValue kdbNetCarbs">4</td><td class="kdbLegendUnits kdbNetCarbs">%</td><td class="kdbLegendValue kdbProtein">11</td><td class="kdbLegendUnits kdbProtein">%</td><td class="kdbLegendValue kdbFat">85</td><td class="kdbLegendUnits kdbFat">%</td></tr></tbody></table></div></div><div class="kdbMacroContentRight"><canvas class="kdbMacroChart" width="140" height="140" style="width: 140px; height: 140px;"></canvas></div></div></div></div>
            </div>

            <div id="resultsCustom" style="display: none;">
                <p>'.__( 'Enter the calorie intake adjustment. For a calorie deficit (weight loss) enter a negative value (e.g. -10) while for a calorie surplus (weight gain) enter a positive value (e.g. 15).', 'keto-calculator' ).'
                    <em>'.__( 'It is recommended that you opt for a moderate calorie deficit or surplus.', 'keto-calculator' ).'</em></p>

                <p><span>'.__( 'Calorie adjustment', 'keto-calculator' ).':</span><input type="text" name="customCalorieAdjustment" value="0" style="border: 4px solid red;"><span>%</span></p>

                <div class="kdbResultCard" id="resultsCustomContent"><div class="kdbMacroOverview"><h4 class="kdbMacroChartTitle">'.__( 'Custom adjustment', 'keto-calculator' ).' (0%)</h4><div class="kdbMacroContent"><div class="kdbMacroContentLeft"><div class="kdbEnergyOverview"><table><tbody><tr><td class="kdbAttributeName">'.__( 'Your BMR is', 'keto-calculator' ).':</td><td class="kdbAttributeValue">1536</td><td class="kdbAttributeUnits">kcal</td></tr><tr><td class="kdbAttributeName">'.__( 'Calories to consume', 'keto-calculator' ).':</td><td class="kdbAttributeValue">2028</td><td class="kdbAttributeUnits">'.__( 'kcal', 'keto-calculator' ).'</td></tr><tr><td class="kdbAttributeName">'.__( 'Your fat intake should be', 'keto-calculator' ).':</td><td class="kdbAttributeValue">184</td><td class="kdbAttributeUnits">'.__( 'grams', 'keto-calculator' ).'</td></tr></tbody></table></div><div class="kdbMacroLegend"><table><tbody><tr><td colspan="2" class="kdbLegendName kdbNetCarbs">'.__( 'Net Carbs', 'keto-calculator' ).'</td><td colspan="2" class="kdbLegendName kdbProtein">'.__( 'Protein', 'keto-calculator' ).'</td><td colspan="2" class="kdbLegendName kdbFat">'.__( 'kcal', 'keto-calculator' ).'</td></tr><tr><td class="kdbLegendValue kdbNetCarbs">25</td><td class="kdbLegendUnits kdbNetCarbs">'.__( 'grams', 'keto-calculator' ).'</td><td class="kdbLegendValue kdbProtein">69</td><td class="kdbLegendUnits kdbProtein">'.__( 'grams', 'keto-calculator' ).'</td><td class="kdbLegendValue kdbFat">184</td><td class="kdbLegendUnits kdbFat">grams</td></tr><tr><td class="kdbLegendValue kdbNetCarbs">100</td><td class="kdbLegendUnits kdbNetCarbs">'.__( 'kcal', 'keto-calculator' ).'</td><td class="kdbLegendValue kdbProtein">275</td><td class="kdbLegendUnits kdbProtein">'.__( 'kcal', 'keto-calculator' ).'</td><td class="kdbLegendValue kdbFat">1653</td><td class="kdbLegendUnits kdbFat">'.__( 'kcal', 'keto-calculator' ).'</td></tr><tr><td class="kdbLegendValue kdbNetCarbs">5</td><td class="kdbLegendUnits kdbNetCarbs">%</td><td class="kdbLegendValue kdbProtein">14</td><td class="kdbLegendUnits kdbProtein">%</td><td class="kdbLegendValue kdbFat">81</td><td class="kdbLegendUnits kdbFat">%</td></tr></tbody></table></div></div><div class="kdbMacroContentRight"><canvas class="kdbMacroChart" width="140" height="140" style="width: 140px; height: 140px;"></canvas></div></div></div></div>
            </div>

        </div>

    </div><span>Based on <a href="https://github.com/ketodiet/keto-calculator">KetoDiet calculator</a></span><!-- Plugin Authors: The Right Software https://therightsw.com/ -->';
    wp_enqueue_style( 'keto-calculator-css' );
    wp_enqueue_script( 'keto-calculator-js' );  
    return stripslashes($Ketoutput);

}
function trs_scripts_basic()
{
    //check whether your content has shortcode
        wp_register_script( 'keto-calculator-js', plugins_url( '/js/keto-calculator.js', __FILE__), array('jquery'),null,true );
		wp_localize_script( 'keto-calculator-js', 'frontend_ketocal_object',
        array( 
            'data_var_1' => __('Your BMR is:', 'keto-calculator' ),
            'data_var_2' => __('Calories to consume:', 'keto-calculator' ),
			'data_var_3' => __('Your fat intake should be:', 'keto-calculator' ),
			'data_var_4' => __('Net Carbs', 'keto-calculator' ),
			'data_var_5' => __('Your net carbs intake is:', 'keto-calculator' ),
			'data_var_6' => __('Protein', 'keto-calculator' ),
			'data_var_7' => __('Fat', 'keto-calculator' ),
			'data_var_8' => __('grams', 'keto-calculator' ),
			'data_var_9' => __('kcal', 'keto-calculator' ),
			'data_var_10' => __('Small calorie deficit', 'keto-calculator' ),
			'data_var_11' => __('Moderate calorie deficit', 'keto-calculator' ),
			'data_var_12' => __('Large calorie deficit', 'keto-calculator' ),
			'data_var_13' => __('Calorie surplus', 'keto-calculator' ),
			'data_var_14' => __('Custom adjustment', 'keto-calculator' ),
        )
    );
    
}

function trs_style_basic()
{
        wp_register_style( 'keto-calculator-css', plugins_url( '/css/keto-calculator.css', __FILE__), array(), null, 'all');
}

add_action( 'wp_enqueue_scripts', 'trs_scripts_basic' );
add_action( 'wp_enqueue_scripts', 'trs_style_basic' );


add_shortcode('trs_keto_calculator', 'trs_keto_calculator');
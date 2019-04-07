/**
 * File customizer-controls.js.
 *
 * Theme Customizer enhancements for a better user experience.
 */

(function ($) {

    // Show/hide navigation background dependent on header layout
    wp.customize('winslow_header_layout', function (setting) {
        var setupControl = function (control) {
            var setActiveState, isDisplayed;

            isDisplayed = function () {
                return 'stacked' == setting.get();
            };

            setActiveState = function () {
                control.active.set(isDisplayed());
            };

            setActiveState();
            setting.bind(setActiveState);
        };
        wp.customize.control('winslow_navigation_background', setupControl);
    });

})(jQuery);

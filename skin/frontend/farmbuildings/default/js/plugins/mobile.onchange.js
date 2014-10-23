// $.fn.quickChange = function(handler) {
//     return this.each(function() {
//         var self = this;
//         self.qcindex = self.selectedIndex;
//         var interval;
//         function handleChange() {
//             if (self.selectedIndex != self.qcindex) {
//                 self.qcindex = self.selectedIndex;
//                 handler.apply(self);
//             }
//         }
//         $(self).focus(function() {
//             interval = setInterval(handleChange, 100);
//         }).blur(function() { window.clearInterval(interval); })
//         .change(handleChange); //also wire the change event in case the interval technique isn't supported (chrome on android)
//     });
// };
// example call this can be used just like $.on('change', function(){});
// $("#mySelect1").quickChange(function() { 
//     var currVal = $(this).val();
//     //populate mySelect2
// });
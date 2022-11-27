/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/student.js":
/*!*********************************!*\
  !*** ./resources/js/student.js ***!
  \*********************************/
/***/ (() => {

eval("$('form').on('click', '.addstudentRow', function () {\n  var $newRow = $('div.add:first').clone();\n  $newRow.find('input.std_id').val('');\n  $newRow.find('input.roll').val('');\n  $newRow.find('input.name').val('');\n  $newRow.find('select.gender').val('');\n  $newRow.find('select.religion').val('');\n  $newRow.find('input.father_name').val('');\n  $newRow.find('input.mother_name').val('');\n  $newRow.find('input.mobile_no').val('');\n  $('.student_table').append($newRow);\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6WyIkIiwib24iLCIkbmV3Um93IiwiY2xvbmUiLCJmaW5kIiwidmFsIiwiYXBwZW5kIl0sInNvdXJjZXMiOlsid2VicGFjazovLy8uL3Jlc291cmNlcy9qcy9zdHVkZW50LmpzPzFmZDEiXSwic291cmNlc0NvbnRlbnQiOlsiXG4kKCdmb3JtJykub24oJ2NsaWNrJywgJy5hZGRzdHVkZW50Um93JywgZnVuY3Rpb24oKXtcbiAgICBcbiAgICBsZXQgJG5ld1JvdyA9ICQoJ2Rpdi5hZGQ6Zmlyc3QnKS5jbG9uZSgpO1xuICAgIFxuICAgICRuZXdSb3cuZmluZCgnaW5wdXQuc3RkX2lkJykudmFsKCcnKTtcbiAgICAkbmV3Um93LmZpbmQoJ2lucHV0LnJvbGwnKS52YWwoJycpO1xuICAgICRuZXdSb3cuZmluZCgnaW5wdXQubmFtZScpLnZhbCgnJyk7XG4gICAgJG5ld1Jvdy5maW5kKCdzZWxlY3QuZ2VuZGVyJykudmFsKCcnKTtcbiAgICAkbmV3Um93LmZpbmQoJ3NlbGVjdC5yZWxpZ2lvbicpLnZhbCgnJyk7XG4gICAgJG5ld1Jvdy5maW5kKCdpbnB1dC5mYXRoZXJfbmFtZScpLnZhbCgnJyk7XG4gICAgJG5ld1Jvdy5maW5kKCdpbnB1dC5tb3RoZXJfbmFtZScpLnZhbCgnJyk7XG4gICAgJG5ld1Jvdy5maW5kKCdpbnB1dC5tb2JpbGVfbm8nKS52YWwoJycpO1xuXG4gICAgXG4gICAgJCgnLnN0dWRlbnRfdGFibGUnKS5hcHBlbmQoJG5ld1Jvdyk7XG59KTsiXSwibWFwcGluZ3MiOiJBQUNBQSxDQUFDLENBQUMsTUFBTSxDQUFDLENBQUNDLEVBQUUsQ0FBQyxPQUFPLEVBQUUsZ0JBQWdCLEVBQUUsWUFBVTtFQUU5QyxJQUFJQyxPQUFPLEdBQUdGLENBQUMsQ0FBQyxlQUFlLENBQUMsQ0FBQ0csS0FBSyxFQUFFO0VBRXhDRCxPQUFPLENBQUNFLElBQUksQ0FBQyxjQUFjLENBQUMsQ0FBQ0MsR0FBRyxDQUFDLEVBQUUsQ0FBQztFQUNwQ0gsT0FBTyxDQUFDRSxJQUFJLENBQUMsWUFBWSxDQUFDLENBQUNDLEdBQUcsQ0FBQyxFQUFFLENBQUM7RUFDbENILE9BQU8sQ0FBQ0UsSUFBSSxDQUFDLFlBQVksQ0FBQyxDQUFDQyxHQUFHLENBQUMsRUFBRSxDQUFDO0VBQ2xDSCxPQUFPLENBQUNFLElBQUksQ0FBQyxlQUFlLENBQUMsQ0FBQ0MsR0FBRyxDQUFDLEVBQUUsQ0FBQztFQUNyQ0gsT0FBTyxDQUFDRSxJQUFJLENBQUMsaUJBQWlCLENBQUMsQ0FBQ0MsR0FBRyxDQUFDLEVBQUUsQ0FBQztFQUN2Q0gsT0FBTyxDQUFDRSxJQUFJLENBQUMsbUJBQW1CLENBQUMsQ0FBQ0MsR0FBRyxDQUFDLEVBQUUsQ0FBQztFQUN6Q0gsT0FBTyxDQUFDRSxJQUFJLENBQUMsbUJBQW1CLENBQUMsQ0FBQ0MsR0FBRyxDQUFDLEVBQUUsQ0FBQztFQUN6Q0gsT0FBTyxDQUFDRSxJQUFJLENBQUMsaUJBQWlCLENBQUMsQ0FBQ0MsR0FBRyxDQUFDLEVBQUUsQ0FBQztFQUd2Q0wsQ0FBQyxDQUFDLGdCQUFnQixDQUFDLENBQUNNLE1BQU0sQ0FBQ0osT0FBTyxDQUFDO0FBQ3ZDLENBQUMsQ0FBQyIsImZpbGUiOiIuL3Jlc291cmNlcy9qcy9zdHVkZW50LmpzLmpzIiwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/student.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/student.js"]();
/******/ 	
/******/ })()
;
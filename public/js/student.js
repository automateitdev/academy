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

eval("$('form').on('click', '.addstudentRow', function () {\n  var $newRow = $('div.add:first').clone();\n  $newRow.find('input.std_id').val('');\n  $newRow.find('input.roll').val('');\n  $newRow.find('input.name').val('');\n  $newRow.find('select.gender').val('');\n  $newRow.find('select.religion').val('');\n  $newRow.find('input.father_name').val('');\n  $newRow.find('input.mother_name').val('');\n  $newRow.find('input.mobile_no').val('');\n  $('.student_table').append($newRow);\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvc3R1ZGVudC5qcy5qcyIsIm5hbWVzIjpbIiQiLCJvbiIsIiRuZXdSb3ciLCJjbG9uZSIsImZpbmQiLCJ2YWwiLCJhcHBlbmQiXSwic291cmNlUm9vdCI6IiIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3Jlc291cmNlcy9qcy9zdHVkZW50LmpzPzFmZDEiXSwic291cmNlc0NvbnRlbnQiOlsiXHJcbiQoJ2Zvcm0nKS5vbignY2xpY2snLCAnLmFkZHN0dWRlbnRSb3cnLCBmdW5jdGlvbigpe1xyXG4gICAgXHJcbiAgICBsZXQgJG5ld1JvdyA9ICQoJ2Rpdi5hZGQ6Zmlyc3QnKS5jbG9uZSgpO1xyXG4gICAgXHJcbiAgICAkbmV3Um93LmZpbmQoJ2lucHV0LnN0ZF9pZCcpLnZhbCgnJyk7XHJcbiAgICAkbmV3Um93LmZpbmQoJ2lucHV0LnJvbGwnKS52YWwoJycpO1xyXG4gICAgJG5ld1Jvdy5maW5kKCdpbnB1dC5uYW1lJykudmFsKCcnKTtcclxuICAgICRuZXdSb3cuZmluZCgnc2VsZWN0LmdlbmRlcicpLnZhbCgnJyk7XHJcbiAgICAkbmV3Um93LmZpbmQoJ3NlbGVjdC5yZWxpZ2lvbicpLnZhbCgnJyk7XHJcbiAgICAkbmV3Um93LmZpbmQoJ2lucHV0LmZhdGhlcl9uYW1lJykudmFsKCcnKTtcclxuICAgICRuZXdSb3cuZmluZCgnaW5wdXQubW90aGVyX25hbWUnKS52YWwoJycpO1xyXG4gICAgJG5ld1Jvdy5maW5kKCdpbnB1dC5tb2JpbGVfbm8nKS52YWwoJycpO1xyXG5cclxuICAgIFxyXG4gICAgJCgnLnN0dWRlbnRfdGFibGUnKS5hcHBlbmQoJG5ld1Jvdyk7XHJcbn0pOyJdLCJtYXBwaW5ncyI6IkFBQ0FBLENBQUMsQ0FBQyxNQUFELENBQUQsQ0FBVUMsRUFBVixDQUFhLE9BQWIsRUFBc0IsZ0JBQXRCLEVBQXdDLFlBQVU7RUFFOUMsSUFBSUMsT0FBTyxHQUFHRixDQUFDLENBQUMsZUFBRCxDQUFELENBQW1CRyxLQUFuQixFQUFkO0VBRUFELE9BQU8sQ0FBQ0UsSUFBUixDQUFhLGNBQWIsRUFBNkJDLEdBQTdCLENBQWlDLEVBQWpDO0VBQ0FILE9BQU8sQ0FBQ0UsSUFBUixDQUFhLFlBQWIsRUFBMkJDLEdBQTNCLENBQStCLEVBQS9CO0VBQ0FILE9BQU8sQ0FBQ0UsSUFBUixDQUFhLFlBQWIsRUFBMkJDLEdBQTNCLENBQStCLEVBQS9CO0VBQ0FILE9BQU8sQ0FBQ0UsSUFBUixDQUFhLGVBQWIsRUFBOEJDLEdBQTlCLENBQWtDLEVBQWxDO0VBQ0FILE9BQU8sQ0FBQ0UsSUFBUixDQUFhLGlCQUFiLEVBQWdDQyxHQUFoQyxDQUFvQyxFQUFwQztFQUNBSCxPQUFPLENBQUNFLElBQVIsQ0FBYSxtQkFBYixFQUFrQ0MsR0FBbEMsQ0FBc0MsRUFBdEM7RUFDQUgsT0FBTyxDQUFDRSxJQUFSLENBQWEsbUJBQWIsRUFBa0NDLEdBQWxDLENBQXNDLEVBQXRDO0VBQ0FILE9BQU8sQ0FBQ0UsSUFBUixDQUFhLGlCQUFiLEVBQWdDQyxHQUFoQyxDQUFvQyxFQUFwQztFQUdBTCxDQUFDLENBQUMsZ0JBQUQsQ0FBRCxDQUFvQk0sTUFBcEIsQ0FBMkJKLE9BQTNCO0FBQ0gsQ0FmRCJ9\n//# sourceURL=webpack-internal:///./resources/js/student.js\n");

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
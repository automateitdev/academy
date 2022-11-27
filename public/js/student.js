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

eval("$('form').on('click', '.addstudentRow', function () {\n  var $newRow = $('div.add:first').clone();\n  $newRow.find('input.std_id').val('');\n  $newRow.find('input.roll').val('');\n  $newRow.find('input.name').val('');\n  $newRow.find('select.gender').val('');\n  $newRow.find('select.religion').val('');\n  $newRow.find('input.father_name').val('');\n  $newRow.find('input.mother_name').val('');\n  $newRow.find('input.mobile_no').val('');\n  $('.student_table').append($newRow);\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6WyIkIiwib24iLCIkbmV3Um93IiwiY2xvbmUiLCJmaW5kIiwidmFsIiwiYXBwZW5kIl0sInNvdXJjZXMiOlsid2VicGFjazovLy8uL3Jlc291cmNlcy9qcy9zdHVkZW50LmpzPzFmZDEiXSwic291cmNlc0NvbnRlbnQiOlsiXHJcbiQoJ2Zvcm0nKS5vbignY2xpY2snLCAnLmFkZHN0dWRlbnRSb3cnLCBmdW5jdGlvbigpe1xyXG4gICAgXHJcbiAgICBsZXQgJG5ld1JvdyA9ICQoJ2Rpdi5hZGQ6Zmlyc3QnKS5jbG9uZSgpO1xyXG4gICAgXHJcbiAgICAkbmV3Um93LmZpbmQoJ2lucHV0LnN0ZF9pZCcpLnZhbCgnJyk7XHJcbiAgICAkbmV3Um93LmZpbmQoJ2lucHV0LnJvbGwnKS52YWwoJycpO1xyXG4gICAgJG5ld1Jvdy5maW5kKCdpbnB1dC5uYW1lJykudmFsKCcnKTtcclxuICAgICRuZXdSb3cuZmluZCgnc2VsZWN0LmdlbmRlcicpLnZhbCgnJyk7XHJcbiAgICAkbmV3Um93LmZpbmQoJ3NlbGVjdC5yZWxpZ2lvbicpLnZhbCgnJyk7XHJcbiAgICAkbmV3Um93LmZpbmQoJ2lucHV0LmZhdGhlcl9uYW1lJykudmFsKCcnKTtcclxuICAgICRuZXdSb3cuZmluZCgnaW5wdXQubW90aGVyX25hbWUnKS52YWwoJycpO1xyXG4gICAgJG5ld1Jvdy5maW5kKCdpbnB1dC5tb2JpbGVfbm8nKS52YWwoJycpO1xyXG5cclxuICAgIFxyXG4gICAgJCgnLnN0dWRlbnRfdGFibGUnKS5hcHBlbmQoJG5ld1Jvdyk7XHJcbn0pOyJdLCJtYXBwaW5ncyI6IkFBQ0FBLENBQUMsQ0FBQyxNQUFNLENBQUMsQ0FBQ0MsRUFBRSxDQUFDLE9BQU8sRUFBRSxnQkFBZ0IsRUFBRSxZQUFVO0VBRTlDLElBQUlDLE9BQU8sR0FBR0YsQ0FBQyxDQUFDLGVBQWUsQ0FBQyxDQUFDRyxLQUFLLEVBQUU7RUFFeENELE9BQU8sQ0FBQ0UsSUFBSSxDQUFDLGNBQWMsQ0FBQyxDQUFDQyxHQUFHLENBQUMsRUFBRSxDQUFDO0VBQ3BDSCxPQUFPLENBQUNFLElBQUksQ0FBQyxZQUFZLENBQUMsQ0FBQ0MsR0FBRyxDQUFDLEVBQUUsQ0FBQztFQUNsQ0gsT0FBTyxDQUFDRSxJQUFJLENBQUMsWUFBWSxDQUFDLENBQUNDLEdBQUcsQ0FBQyxFQUFFLENBQUM7RUFDbENILE9BQU8sQ0FBQ0UsSUFBSSxDQUFDLGVBQWUsQ0FBQyxDQUFDQyxHQUFHLENBQUMsRUFBRSxDQUFDO0VBQ3JDSCxPQUFPLENBQUNFLElBQUksQ0FBQyxpQkFBaUIsQ0FBQyxDQUFDQyxHQUFHLENBQUMsRUFBRSxDQUFDO0VBQ3ZDSCxPQUFPLENBQUNFLElBQUksQ0FBQyxtQkFBbUIsQ0FBQyxDQUFDQyxHQUFHLENBQUMsRUFBRSxDQUFDO0VBQ3pDSCxPQUFPLENBQUNFLElBQUksQ0FBQyxtQkFBbUIsQ0FBQyxDQUFDQyxHQUFHLENBQUMsRUFBRSxDQUFDO0VBQ3pDSCxPQUFPLENBQUNFLElBQUksQ0FBQyxpQkFBaUIsQ0FBQyxDQUFDQyxHQUFHLENBQUMsRUFBRSxDQUFDO0VBR3ZDTCxDQUFDLENBQUMsZ0JBQWdCLENBQUMsQ0FBQ00sTUFBTSxDQUFDSixPQUFPLENBQUM7QUFDdkMsQ0FBQyxDQUFDIiwiZmlsZSI6Ii4vcmVzb3VyY2VzL2pzL3N0dWRlbnQuanMuanMiLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/js/student.js\n");

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
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

/***/ "./resources/js/payment.js":
/*!*********************************!*\
  !*** ./resources/js/payment.js ***!
  \*********************************/
/***/ (() => {

eval("function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }\n$(document).ready(function () {\n  $(document).on('click', '#spgbtn', function () {\n    var _$$ajax;\n    console.log('asi gachi');\n    $.ajax((_$$ajax = {\n      type: 'post',\n      url: 'https://spgapi.sblesheba.com:6314/api/v2/SpgService/GetAccessToken',\n      header: 'Content-Type: application/json'\n    }, _defineProperty(_$$ajax, \"header\", 'Authorization: Basic ZHVVc2VyMjAxNDpkdVVzZXJQYXltZW50MjAxNA=='), _defineProperty(_$$ajax, \"data\", {\n      'AccessUser': {\n        'userName': 'duUser2014',\n        'password': 'duUserPayment2014'\n      },\n      'invoiceNo': 'INV155422121443',\n      'amount': '400',\n      'invoiceDate': '2019-02-26',\n      'accounts': [{\n        'crAccount': '0002634313655',\n        'crAmount': 200\n      }, {\n        'crAccount': '0002634313651',\n        'crAmount': 200\n      }]\n    }), _defineProperty(_$$ajax, \"success\", function success(data) {\n      console.log(data);\n    }), _$$ajax));\n  });\n});\n\n///////# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvcGF5bWVudC5qcy5qcyIsIm5hbWVzIjpbIiQiLCJkb2N1bWVudCIsInJlYWR5Iiwib24iLCJjb25zb2xlIiwibG9nIiwiYWpheCIsInR5cGUiLCJ1cmwiLCJoZWFkZXIiLCJkYXRhIl0sInNvdXJjZVJvb3QiOiIiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvcGF5bWVudC5qcz9mZjI1Il0sInNvdXJjZXNDb250ZW50IjpbIlxyXG4kKGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbigpe1xyXG4gICAgJChkb2N1bWVudCkub24oJ2NsaWNrJywgJyNzcGdidG4nLCBmdW5jdGlvbigpe1xyXG4gICAgICBcclxuICBjb25zb2xlLmxvZygnYXNpIGdhY2hpJyk7XHJcblxyXG5cclxuICAgICAgJC5hamF4KHtcclxuICAgICAgICB0eXBlOidwb3N0JyxcclxuICAgICAgICB1cmw6ICdodHRwczovL3NwZ2FwaS5zYmxlc2hlYmEuY29tOjYzMTQvYXBpL3YyL1NwZ1NlcnZpY2UvR2V0QWNjZXNzVG9rZW4nLFxyXG5cclxuICAgICAgICBoZWFkZXI6ICdDb250ZW50LVR5cGU6IGFwcGxpY2F0aW9uL2pzb24nLFxyXG4gICAgICAgIGhlYWRlcjonQXV0aG9yaXphdGlvbjogQmFzaWMgWkhWVmMyVnlNakF4TkRwa2RWVnpaWEpRWVhsdFpXNTBNakF4TkE9PScsXHJcbiAgICAgICAgZGF0YTp7ICdBY2Nlc3NVc2VyJzp7XHJcbiAgICAgICAgICAgICd1c2VyTmFtZSc6J2R1VXNlcjIwMTQnLFxyXG4gICAgICAgICAgICAncGFzc3dvcmQnOidkdVVzZXJQYXltZW50MjAxNCcgfSxcclxuICAgICAgICAgICAgJ2ludm9pY2VObyc6J0lOVjE1NTQyMjEyMTQ0MycsICdhbW91bnQnOic0MDAnLCAnaW52b2ljZURhdGUnOicyMDE5LTAyLTI2JywgJ2FjY291bnRzJzogW1xyXG4gICAgICAgICAgICB7XHJcbiAgICAgICAgICAgICdjckFjY291bnQnOiAnMDAwMjYzNDMxMzY1NScsICdjckFtb3VudCc6IDIwMFxyXG4gICAgICAgICAgICB9LCB7XHJcbiAgICAgICAgICAgICdjckFjY291bnQnOiAnMDAwMjYzNDMxMzY1MScsICdjckFtb3VudCc6IDIwMFxyXG4gICAgICAgICAgICB9IF1cclxuICAgICAgICAgICAgfSxcclxuICAgICAgICAvLyBkYXRhVHlwZSA6ICdqc29uJyxcclxuICAgICAgICBzdWNjZXNzOiBmdW5jdGlvbihkYXRhKXtcclxuICAgICAgICAgIFxyXG4gICAgICAgICAgY29uc29sZS5sb2coZGF0YSk7XHJcbiAgXHJcbiAgICAgICAgfSxcclxuICBcclxuICAgICAgfSk7XHJcbiAgXHJcbiAgICB9KTtcclxuICB9KTtcclxuXHJcblxyXG5cclxuLy8vLy9cclxuXHJcbiAiXSwibWFwcGluZ3MiOiI7QUFDQUEsQ0FBQyxDQUFDQyxRQUFRLENBQUMsQ0FBQ0MsS0FBSyxDQUFDLFlBQVU7RUFDeEJGLENBQUMsQ0FBQ0MsUUFBUSxDQUFDLENBQUNFLEVBQUUsQ0FBQyxPQUFPLEVBQUUsU0FBUyxFQUFFLFlBQVU7SUFBQTtJQUUvQ0MsT0FBTyxDQUFDQyxHQUFHLENBQUMsV0FBVyxDQUFDO0lBR3BCTCxDQUFDLENBQUNNLElBQUk7TUFDSkMsSUFBSSxFQUFDLE1BQU07TUFDWEMsR0FBRyxFQUFFLG9FQUFvRTtNQUV6RUMsTUFBTSxFQUFFO0lBQWdDLHNDQUNqQywrREFBK0Qsb0NBQ2pFO01BQUUsWUFBWSxFQUFDO1FBQ2hCLFVBQVUsRUFBQyxZQUFZO1FBQ3ZCLFVBQVUsRUFBQztNQUFvQixDQUFDO01BQ2hDLFdBQVcsRUFBQyxpQkFBaUI7TUFBRSxRQUFRLEVBQUMsS0FBSztNQUFFLGFBQWEsRUFBQyxZQUFZO01BQUUsVUFBVSxFQUFFLENBQ3ZGO1FBQ0EsV0FBVyxFQUFFLGVBQWU7UUFBRSxVQUFVLEVBQUU7TUFDMUMsQ0FBQyxFQUFFO1FBQ0gsV0FBVyxFQUFFLGVBQWU7UUFBRSxVQUFVLEVBQUU7TUFDMUMsQ0FBQztJQUNELENBQUMsdUNBRUksaUJBQVNDLElBQUksRUFBQztNQUVyQk4sT0FBTyxDQUFDQyxHQUFHLENBQUNLLElBQUksQ0FBQztJQUVuQixDQUFDLFlBRUQ7RUFFSixDQUFDLENBQUM7QUFDSixDQUFDLENBQUM7O0FBSUoifQ==\n//# sourceURL=webpack-internal:///./resources/js/payment.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/payment.js"]();
/******/ 	
/******/ })()
;
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

eval("$(document).ready(function () {\n  $(document).on('click', '#spgbtn', function () {\n    console.log('asi gachi');\n    $.ajax({\n      type: 'options',\n      url: 'https://spgapi.sblesheba.com:6314/api/v2/SpgService/GetAccessToken',\n      headers: {\n        'Access-Control-Allow-Origin': 'http://127.0.0.1:8000',\n        'Content-Type': 'application/json',\n        'Authorization': 'Basic ZHVVc2VyMjAxNDpkdVVzZXJQYXltZW50MjAxNA=='\n        // 'X-CSRF-TOKEN': $('meta[name=\"csrf-token\"]').attr('content')\n      },\n\n      dataType: 'jsonp',\n      CrossDomain: true,\n      data: {\n        'AccessUser': {\n          'userName': 'duUser2014',\n          'password': 'duUserPayment2014'\n        },\n        'invoiceNo': 'INV155422121443',\n        'amount': '400',\n        'invoiceDate': '2019-02-26',\n        'accounts': [{\n          'crAccount': '0002634313655',\n          'crAmount': 200\n        }, {\n          'crAccount': '0002634313651',\n          'crAmount': 200\n        }]\n      },\n      processData: false,\n      success: function success(data) {\n        console.log(data);\n      }\n    });\n  });\n});\n\n///////# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvcGF5bWVudC5qcy5qcyIsIm5hbWVzIjpbIiQiLCJkb2N1bWVudCIsInJlYWR5Iiwib24iLCJjb25zb2xlIiwibG9nIiwiYWpheCIsInR5cGUiLCJ1cmwiLCJoZWFkZXJzIiwiZGF0YVR5cGUiLCJDcm9zc0RvbWFpbiIsImRhdGEiLCJwcm9jZXNzRGF0YSIsInN1Y2Nlc3MiXSwic291cmNlUm9vdCI6IiIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3Jlc291cmNlcy9qcy9wYXltZW50LmpzP2ZmMjUiXSwic291cmNlc0NvbnRlbnQiOlsiXG4kKGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbiAoKSB7XG4gICQoZG9jdW1lbnQpLm9uKCdjbGljaycsICcjc3BnYnRuJywgZnVuY3Rpb24gKCkge1xuXG4gICAgY29uc29sZS5sb2coJ2FzaSBnYWNoaScpO1xuXG5cbiAgICAkLmFqYXgoe1xuICAgICAgdHlwZTogJ29wdGlvbnMnLFxuICAgICAgdXJsOiAnaHR0cHM6Ly9zcGdhcGkuc2JsZXNoZWJhLmNvbTo2MzE0L2FwaS92Mi9TcGdTZXJ2aWNlL0dldEFjY2Vzc1Rva2VuJyxcbiAgICAgIGhlYWRlcnM6IHtcbiAgICAgICAgJ0FjY2Vzcy1Db250cm9sLUFsbG93LU9yaWdpbic6ICdodHRwOi8vMTI3LjAuMC4xOjgwMDAnLFxuICAgICAgICAnQ29udGVudC1UeXBlJzogJ2FwcGxpY2F0aW9uL2pzb24nLFxuICAgICAgICAnQXV0aG9yaXphdGlvbic6ICdCYXNpYyBaSFZWYzJWeU1qQXhORHBrZFZWelpYSlFZWGx0Wlc1ME1qQXhOQT09JyxcbiAgICAgICAgLy8gJ1gtQ1NSRi1UT0tFTic6ICQoJ21ldGFbbmFtZT1cImNzcmYtdG9rZW5cIl0nKS5hdHRyKCdjb250ZW50JylcbiAgICAgIH0sXG4gICAgICBkYXRhVHlwZTogJ2pzb25wJyxcbiAgICAgIENyb3NzRG9tYWluOiB0cnVlLFxuICAgICAgZGF0YToge1xuICAgICAgICAnQWNjZXNzVXNlcic6IHtcbiAgICAgICAgICAndXNlck5hbWUnOiAnZHVVc2VyMjAxNCcsXG4gICAgICAgICAgJ3Bhc3N3b3JkJzogJ2R1VXNlclBheW1lbnQyMDE0J1xuICAgICAgICB9LFxuICAgICAgICAnaW52b2ljZU5vJzogJ0lOVjE1NTQyMjEyMTQ0MycsICdhbW91bnQnOiAnNDAwJywgJ2ludm9pY2VEYXRlJzogJzIwMTktMDItMjYnLCAnYWNjb3VudHMnOiBbXG4gICAgICAgICAge1xuICAgICAgICAgICAgJ2NyQWNjb3VudCc6ICcwMDAyNjM0MzEzNjU1JywgJ2NyQW1vdW50JzogMjAwXG4gICAgICAgICAgfSwge1xuICAgICAgICAgICAgJ2NyQWNjb3VudCc6ICcwMDAyNjM0MzEzNjUxJywgJ2NyQW1vdW50JzogMjAwXG4gICAgICAgICAgfV1cbiAgICAgIH0sXG5cbiAgICAgIHByb2Nlc3NEYXRhOiBmYWxzZSxcbiAgICAgIHN1Y2Nlc3M6IGZ1bmN0aW9uIChkYXRhKSB7XG5cbiAgICAgICAgY29uc29sZS5sb2coZGF0YSk7XG5cbiAgICAgIH0sXG5cbiAgICB9KTtcblxuICB9KTtcbn0pO1xuXG5cblxuICAvLy8vL1xuXG4iXSwibWFwcGluZ3MiOiJBQUNBQSxDQUFDLENBQUNDLFFBQVEsQ0FBQyxDQUFDQyxLQUFLLENBQUMsWUFBWTtFQUM1QkYsQ0FBQyxDQUFDQyxRQUFRLENBQUMsQ0FBQ0UsRUFBRSxDQUFDLE9BQU8sRUFBRSxTQUFTLEVBQUUsWUFBWTtJQUU3Q0MsT0FBTyxDQUFDQyxHQUFHLENBQUMsV0FBVyxDQUFDO0lBR3hCTCxDQUFDLENBQUNNLElBQUksQ0FBQztNQUNMQyxJQUFJLEVBQUUsU0FBUztNQUNmQyxHQUFHLEVBQUUsb0VBQW9FO01BQ3pFQyxPQUFPLEVBQUU7UUFDUCw2QkFBNkIsRUFBRSx1QkFBdUI7UUFDdEQsY0FBYyxFQUFFLGtCQUFrQjtRQUNsQyxlQUFlLEVBQUU7UUFDakI7TUFDRixDQUFDOztNQUNEQyxRQUFRLEVBQUUsT0FBTztNQUNqQkMsV0FBVyxFQUFFLElBQUk7TUFDakJDLElBQUksRUFBRTtRQUNKLFlBQVksRUFBRTtVQUNaLFVBQVUsRUFBRSxZQUFZO1VBQ3hCLFVBQVUsRUFBRTtRQUNkLENBQUM7UUFDRCxXQUFXLEVBQUUsaUJBQWlCO1FBQUUsUUFBUSxFQUFFLEtBQUs7UUFBRSxhQUFhLEVBQUUsWUFBWTtRQUFFLFVBQVUsRUFBRSxDQUN4RjtVQUNFLFdBQVcsRUFBRSxlQUFlO1VBQUUsVUFBVSxFQUFFO1FBQzVDLENBQUMsRUFBRTtVQUNELFdBQVcsRUFBRSxlQUFlO1VBQUUsVUFBVSxFQUFFO1FBQzVDLENBQUM7TUFDTCxDQUFDO01BRURDLFdBQVcsRUFBRSxLQUFLO01BQ2xCQyxPQUFPLEVBQUUsaUJBQVVGLElBQUksRUFBRTtRQUV2QlIsT0FBTyxDQUFDQyxHQUFHLENBQUNPLElBQUksQ0FBQztNQUVuQjtJQUVGLENBQUMsQ0FBQztFQUVKLENBQUMsQ0FBQztBQUNKLENBQUMsQ0FBQzs7QUFJQSJ9\n//# sourceURL=webpack-internal:///./resources/js/payment.js\n");

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
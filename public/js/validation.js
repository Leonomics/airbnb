/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/validation.js":
/*!************************************!*\
  !*** ./resources/js/validation.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }
function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }
var errorList = {
  title: 'Il titolo non deve superare i 255 caratteri',
  rooms: 'Inserire un numero valido',
  beds: 'Inserire un numero valido',
  baths: 'Inserire un numero valido',
  meters: 'Inserire un numero valido',
  address: 'Inserire un indirizzo valido',
  price: 'Inserire un numero valido'
};
var form = document.getElementById('form');
var address = document.querySelector('.address');
if (form) {
  form.addEventListener('change', onChange);
  form.addEventListener('focusout', onFocusOut);
  address.addEventListener('change', checkAddress);
}
function onChange(e) {
  var el = e.target;
  if (el.id === 'image' || el.id === 'images') {
    checkSize(el);
  }
}
function onFocusOut(e) {
  var el = e.target;
  if (el.id === 'title' || el.id === 'rooms' || el.id === 'beds' || el.id === 'baths' || el.id === 'meters' || el.id === 'price') {
    checkValue(el);
  }
}
function checkSize(el) {
  var id = el.id.concat('_error');
  var image_error = document.getElementById(id);
  var files = _toConsumableArray(el.files);
  files.every(function (image) {
    if (image.size > 2097152) {
      image_error.classList.remove('hidden');
      return false;
    } else {
      image_error.classList.add('hidden');
    }
  });
}
function checkValue(el) {
  var id = el.id;
  var wrapper = form.querySelector(".".concat(id, "-wrapper"));
  var error = form.querySelector(".".concat(id, "-error"));
  error.textContent = '';
  wrapper.classList.remove('text-red-700');
  el.classList.remove('border-red-700', 'border-2');
  if (!el.validity.valid) {
    error.textContent = errorList[id];
    wrapper.classList.add('text-red-700');
    el.classList.add('border-red-700', 'border-2');
  }
}
function checkAddress() {
  var wrapper = form.querySelector('.address-wrapper');
  var error = form.querySelector('.address-error');
  error.textContent = '';
  wrapper.classList.remove('text-red-700');
  this.classList.remove('border-red-700', 'border-2');
  if (!this.value) {
    error.textContent = errorList.address;
    wrapper.classList.add('text-red-700');
    this.classList.add('border-red-700', 'border-2');
  }
}

/***/ }),

/***/ 2:
/*!******************************************!*\
  !*** multi ./resources/js/validation.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Users\leocv\OneDrive\Desktop\developer\boolbnb-main\resources\js\validation.js */"./resources/js/validation.js");


/***/ })

/******/ });
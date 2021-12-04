/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/tracker/url.js":
/*!*************************************!*\
  !*** ./resources/js/tracker/url.js ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "removeTrailingSlash": () => (/* binding */ removeTrailingSlash)
/* harmony export */ });
function removeTrailingSlash(url) {
  return url && url.length > 1 && url.endsWith('/') ? url.slice(0, -1) : url;
}

/***/ }),

/***/ "./resources/js/tracker/web.js":
/*!*************************************!*\
  !*** ./resources/js/tracker/web.js ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "hook": () => (/* binding */ hook),
/* harmony export */   "doNotTrack": () => (/* binding */ doNotTrack)
/* harmony export */ });
var hook = function hook(_this, method, callback) {
  var orig = _this[method];
  return function () {
    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    callback.apply(null, args);
    return orig.apply(_this, args);
  };
};
var doNotTrack = function doNotTrack() {
  var _window = window,
      doNotTrack = _window.doNotTrack,
      navigator = _window.navigator,
      external = _window.external;
  var msTrackProtection = 'msTrackingProtectionEnabled';

  var msTracking = function msTracking() {
    return external && msTrackProtection in external && external[msTrackProtection]();
  };

  var dnt = doNotTrack || navigator.doNotTrack || navigator.msDoNotTrack || msTracking();
  return dnt == '1' || dnt === 'yes';
};

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!***************************************!*\
  !*** ./resources/js/tracker/index.js ***!
  \***************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _web__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./web */ "./resources/js/tracker/web.js");
/* harmony import */ var _url__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./url */ "./resources/js/tracker/url.js");
function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { var _i = arr == null ? null : typeof Symbol !== "undefined" && arr[Symbol.iterator] || arr["@@iterator"]; if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }




(function (window) {
  var _window$screen = window.screen,
      width = _window$screen.width,
      height = _window$screen.height,
      language = window.navigator.language,
      _window$location = window.location,
      hostname = _window$location.hostname,
      pathname = _window$location.pathname,
      search = _window$location.search,
      localStorage = window.localStorage,
      sessionStorage = window.sessionStorage,
      document = window.document,
      history = window.history;
  var script = document.querySelector('script[data-volante]');
  if (!script) return;
  var attr = script.getAttribute.bind(script);
  var website = attr('data-website-id');
  var hostUrl = attr('data-host-url');
  var autoTrack = attr('data-auto-track') !== 'false';
  var dnt = attr('data-do-not-track');
  var useCache = attr('data-cache');
  var domain = attr('data-domains') || '';
  var domains = domain.split(',').map(function (n) {
    return n.trim();
  });
  var eventClass = /^volante--([a-z]+)--([\w]+[\w-]*)$/;
  var eventSelect = "[class*='volante--']";
  var cacheKey = 'volante.cache';

  var disableTracking = function disableTracking() {
    return localStorage && localStorage.getItem('volante.disabled') || dnt && (0,_web__WEBPACK_IMPORTED_MODULE_0__.doNotTrack)() || domain && !domains.includes(hostname);
  };

  var root = hostUrl ? (0,_url__WEBPACK_IMPORTED_MODULE_1__.removeTrailingSlash)(hostUrl) : script.src.split('/').slice(0, -4).join('/');
  var screen = "".concat(width, "x").concat(height);
  var listeners = {};
  var currentUrl = "".concat(pathname).concat(search);
  var currentRef = document.referrer;
  /* Collect metrics */

  var post = function post(url, data, callback) {
    var req = new XMLHttpRequest();
    req.open('POST', url, true);
    req.setRequestHeader('Content-Type', 'application/json');

    req.onreadystatechange = function () {
      if (req.readyState === 4) {
        callback(req.response);
      }
    };

    req.send(JSON.stringify(data));
  };

  var collect = function collect(type, params, uuid) {
    if (disableTracking()) return;
    var payload = {
      website: uuid,
      hostname: hostname,
      screen: screen,
      language: language,
      cache: useCache && sessionStorage.getItem(cacheKey)
    };
    Object.keys(params).forEach(function (key) {
      payload[key] = params[key];
    });
    post("".concat(root, "/api/volante/collect"), {
      type: type,
      payload: payload
    }, function (res) {
      return useCache && sessionStorage.setItem(cacheKey, res);
    });
  };

  var trackView = function trackView() {
    var url = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : currentUrl;
    var referrer = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : currentRef;
    var uuid = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : website;
    collect('pageview', {
      url: url,
      referrer: referrer
    }, uuid);
  };

  var trackEvent = function trackEvent(event_value) {
    var event_type = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'custom';
    var url = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : currentUrl;
    var uuid = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : website;
    collect('event', {
      event_type: event_type,
      event_value: event_value,
      url: url
    }, uuid);
  };
  /* Handle events */


  var addEvent = function addEvent(element) {
    element.className.split(' ').forEach(function (className) {
      if (!eventClass.test(className)) return;

      var _className$split = className.split('--'),
          _className$split2 = _slicedToArray(_className$split, 3),
          type = _className$split2[1],
          value = _className$split2[2];

      var listener = listeners[className] ? listeners[className] : listeners[className] = function () {
        return trackEvent(value, type);
      };
      element.addEventListener(type, listener, true);
    });
  };

  var monitorMutate = function monitorMutate(mutations) {
    mutations.forEach(function (mutation) {
      var element = mutation.target;
      addEvent(element);
      element.querySelectorAll(eventSelect).forEach(addEvent);
    });
  };
  /* Handle history changes */


  var handlePush = function handlePush(state, title, url) {
    if (!url) return;
    currentRef = currentUrl;
    var newUrl = url.toString();

    if (newUrl.substring(0, 4) === 'http') {
      currentUrl = '/' + newUrl.split('/').splice(3).join('/');
    } else {
      currentUrl = newUrl;
    }

    if (currentUrl !== currentRef) {
      trackView();
    }
  };
  /* Global */


  if (!window.volante) {
    var volante = function volante(eventValue) {
      return trackEvent(eventValue);
    };

    volante.trackView = trackView;
    volante.trackEvent = trackEvent;
    window.volante = volante;
  }
  /* Start */


  if (autoTrack && !disableTracking()) {
    history.pushState = (0,_web__WEBPACK_IMPORTED_MODULE_0__.hook)(history, 'pushState', handlePush);
    history.replaceState = (0,_web__WEBPACK_IMPORTED_MODULE_0__.hook)(history, 'replaceState', handlePush);

    var update = function update() {
      switch (document.readyState) {
        /* DOM rendered, add event listeners */
        case 'interactive':
          {
            document.querySelectorAll(eventSelect).forEach(addEvent);
            var observer = new MutationObserver(monitorMutate);
            observer.observe(document, {
              childList: true,
              subtree: true
            });
            break;
          }

        /* Page loaded, track our view */

        case 'complete':
          trackView();
          break;
      }
    };

    document.addEventListener('readystatechange', update, true);
    update();
  }
})(window);
})();

/******/ })()
;
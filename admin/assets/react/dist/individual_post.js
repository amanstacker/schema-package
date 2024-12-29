/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./individual/metabox.jsx":
/*!********************************!*\
  !*** ./individual/metabox.jsx ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _style_common_css__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./style/common.css */ \"./individual/style/common.css\");\n/* harmony import */ var _shared_schemaTypes__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../shared/schemaTypes */ \"./shared/schemaTypes.jsx\");\n/* harmony import */ var _shared_ElementGenerator_ElementGenerator__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../shared/ElementGenerator/ElementGenerator */ \"./shared/ElementGenerator/ElementGenerator.jsx\");\nfunction _toConsumableArray(r) { return _arrayWithoutHoles(r) || _iterableToArray(r) || _unsupportedIterableToArray(r) || _nonIterableSpread(); }\nfunction _nonIterableSpread() { throw new TypeError(\"Invalid attempt to spread non-iterable instance.\\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.\"); }\nfunction _iterableToArray(r) { if (\"undefined\" != typeof Symbol && null != r[Symbol.iterator] || null != r[\"@@iterator\"]) return Array.from(r); }\nfunction _arrayWithoutHoles(r) { if (Array.isArray(r)) return _arrayLikeToArray(r); }\nfunction _slicedToArray(r, e) { return _arrayWithHoles(r) || _iterableToArrayLimit(r, e) || _unsupportedIterableToArray(r, e) || _nonIterableRest(); }\nfunction _nonIterableRest() { throw new TypeError(\"Invalid attempt to destructure non-iterable instance.\\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.\"); }\nfunction _unsupportedIterableToArray(r, a) { if (r) { if (\"string\" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return \"Object\" === t && r.constructor && (t = r.constructor.name), \"Map\" === t || \"Set\" === t ? Array.from(r) : \"Arguments\" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }\nfunction _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }\nfunction _iterableToArrayLimit(r, l) { var t = null == r ? null : \"undefined\" != typeof Symbol && r[Symbol.iterator] || r[\"@@iterator\"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t[\"return\"] && (u = t[\"return\"](), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }\nfunction _arrayWithHoles(r) { if (Array.isArray(r)) return r; }\n/**\r\n * WordPress dependencies\r\n */\nvar _wp$data = wp.data,\n  subscribe = _wp$data.subscribe,\n  select = _wp$data.select;\nvar _wp$components = wp.components,\n  BaseControl = _wp$components.BaseControl,\n  Button = _wp$components.Button,\n  ExternalLink = _wp$components.ExternalLink,\n  PanelBody = _wp$components.PanelBody,\n  PanelRow = _wp$components.PanelRow,\n  Placeholder = _wp$components.Placeholder,\n  Spinner = _wp$components.Spinner,\n  ToggleControl = _wp$components.ToggleControl,\n  SelectControl = _wp$components.SelectControl,\n  Modal = _wp$components.Modal,\n  ComboboxControl = _wp$components.ComboboxControl,\n  Tooltip = _wp$components.Tooltip;\nvar _wp$element = wp.element,\n  render = _wp$element.render,\n  Component = _wp$element.Component,\n  Fragment = _wp$element.Fragment,\n  useState = _wp$element.useState,\n  useEffect = _wp$element.useEffect,\n  useRef = _wp$element.useRef;\n\n/**\r\n * Internal dependencies\r\n */\n\n\n\nvar Metabox = function Metabox() {\n  var __ = wp.i18n.__;\n  var hasPageBeenRenderd = useRef({\n    effect: false\n  });\n  var _useState = useState([]),\n    _useState2 = _slicedToArray(_useState, 2),\n    postMeta = _useState2[0],\n    setPostMeta = _useState2[1];\n  var _useState3 = useState(false),\n    _useState4 = _slicedToArray(_useState3, 2),\n    chooseSchemaModal = _useState4[0],\n    setChooseSchemaModal = _useState4[1];\n  var _useState5 = useState([]),\n    _useState6 = _slicedToArray(_useState5, 2),\n    selectedSchema = _useState6[0],\n    setSelectedSchema = _useState6[1];\n  var _useState7 = useState(false),\n    _useState8 = _slicedToArray(_useState7, 2),\n    dataUpdated = _useState8[0],\n    setdataUpdated = _useState8[1];\n  var handleSchemaTurnOnOff = function handleSchemaTurnOnOff(i, id) {\n    var copyMeta = _toConsumableArray(postMeta);\n    copyMeta[i]['is_enable'] = !copyMeta[i]['is_enable'];\n    setPostMeta(copyMeta);\n    setdataUpdated(function (prevState) {\n      return !prevState;\n    });\n  };\n  var handleSchemaEdit = function handleSchemaEdit(i, id) {\n    var copyMeta = _toConsumableArray(postMeta);\n    copyMeta[i]['is_setup_popup'] = !copyMeta[i]['is_setup_popup'];\n    setPostMeta(copyMeta);\n  };\n  var handleCloseModal = function handleCloseModal(i, id) {\n    var copyMeta = _toConsumableArray(postMeta);\n    copyMeta[i]['is_setup_popup'] = false;\n    setPostMeta(copyMeta);\n  };\n  var handleSchemaDelete = function handleSchemaDelete(i, id) {\n    var copyMeta = _toConsumableArray(postMeta);\n    copyMeta[i]['is_delete_popup'] = !copyMeta[i]['is_delete_popup'];\n    setPostMeta(copyMeta);\n  };\n  var handleSchemaDeleteYes = function handleSchemaDeleteYes(i, id) {\n    var copyMeta = _toConsumableArray(postMeta);\n    copyMeta.splice(i, 1);\n    setPostMeta(copyMeta);\n    setdataUpdated(function (prevState) {\n      return !prevState;\n    });\n  };\n  var handleSchemaDeleteNo = function handleSchemaDeleteNo(i, id) {\n    var copyMeta = _toConsumableArray(postMeta);\n    copyMeta[i]['is_delete_popup'] = false;\n    setPostMeta(copyMeta);\n  };\n  var handleRemoveImage = function handleRemoveImage(e, i, j, k, id, elid, tid, repeater) {\n    e.preventDefault();\n    var copyMeta = _toConsumableArray(postMeta);\n    if (repeater) {\n      copyMeta[i]['properties'][j]['elements'][elid][tid]['value'].splice(k, 1);\n    } else {\n      copyMeta[i]['properties'][j]['value'].splice(k, 1);\n    }\n    setPostMeta(copyMeta);\n  };\n  var handlePropertyChange = function handlePropertyChange(e, i, j, property_type, multiple, elid, tid, repeater) {\n    var copyMeta = _toConsumableArray(postMeta);\n    if (property_type == 'media') {\n      var image_arr = [];\n      var media_uploader = wp.media({\n        title: \"Schema Image\",\n        button: {\n          text: \"Select Image\"\n        },\n        multiple: multiple,\n        library: {\n          type: 'image'\n        }\n      }).on(\"select\", function () {\n        media_uploader.state().get('selection').map(function (attachment) {\n          attachment.toJSON();\n          var image_data = {};\n          image_data.id = attachment['id'];\n          image_data.url = attachment.attributes.sizes.full.url;\n          image_data.width = attachment.attributes.sizes.full.width;\n          image_data.height = attachment.attributes.sizes.full.height;\n          image_arr.push(image_data);\n        });\n        if (repeater) {\n          var arrold = copyMeta[i]['properties'][j]['elements'][elid][tid]['value'];\n          if (multiple) {\n            var merged = [].concat(_toConsumableArray(arrold), image_arr);\n            copyMeta[i]['properties'][j]['elements'][elid][tid]['value'] = Array.from(new Set(merged.map(JSON.stringify))).map(JSON.parse);\n          } else {\n            copyMeta[i]['properties'][j]['elements'][elid][tid]['value'] = image_arr;\n          }\n          setPostMeta(copyMeta);\n        } else {\n          var _arrold = copyMeta[i]['properties'][j]['value'];\n          if (multiple) {\n            var _merged = [].concat(_toConsumableArray(_arrold), image_arr);\n            copyMeta[i]['properties'][j]['value'] = Array.from(new Set(_merged.map(JSON.stringify))).map(JSON.parse);\n          } else {\n            copyMeta[i]['properties'][j]['value'] = image_arr;\n          }\n          setPostMeta(copyMeta);\n        }\n      }).open();\n    } else {\n      if (repeater) {\n        var value;\n        if (copyMeta[i]['properties'][j]['elements'][elid][tid]['type'] == 'checkbox') {\n          value = e.target.checked;\n        } else {\n          value = e.target.value;\n        }\n        copyMeta[i]['properties'][j]['elements'][elid][tid]['value'] = value;\n        setPostMeta(copyMeta);\n      } else {\n        if (property_type == 'checkbox') {\n          var _value = e.target.checked;\n          if (j == 'speakable') {\n            if (_value) {\n              copyMeta[i]['properties']['speakable_selectors']['display'] = true;\n            } else {\n              copyMeta[i]['properties']['speakable_selectors']['display'] = false;\n            }\n          }\n          if (j == 'is_paywalled') {\n            if (_value) {\n              copyMeta[i]['properties']['paywalled_selectors']['display'] = true;\n            } else {\n              copyMeta[i]['properties']['paywalled_selectors']['display'] = false;\n            }\n          }\n          if (j == 'include_video') {\n            Object.keys(copyMeta[i]['properties']).forEach(function (key) {\n              if (copyMeta[i]['properties'][key]['type'] == 'repeater') {\n                copyMeta[i]['properties'][key]['elements'].map(function (item, o) {\n                  Object.keys(item).forEach(function (ekey) {\n                    if (typeof item[ekey]['class'] !== \"undefined\") {\n                      if (item[ekey]['class'].includes('smpg_common_properties')) {\n                        if (_value) {\n                          item[ekey]['display'] = true;\n                        } else {\n                          item[ekey]['display'] = false;\n                        }\n                      }\n                    }\n                  });\n                });\n              } else {\n                if (typeof copyMeta[i]['properties'][key]['class'] !== \"undefined\") {\n                  if (copyMeta[i]['properties'][key]['class'].includes('smpg_common_properties')) {\n                    if (_value) {\n                      copyMeta[i]['properties'][key]['display'] = true;\n                    } else {\n                      copyMeta[i]['properties'][key]['display'] = false;\n                    }\n                  }\n                }\n              }\n            });\n          }\n          copyMeta[i]['properties'][j]['value'] = _value;\n          setPostMeta(copyMeta);\n        } else if (property_type == 'multiselect') {\n          var _value2 = Array.from(e.target.selectedOptions, function (item) {\n            return item.value;\n          });\n          copyMeta[i]['properties'][j]['value'] = _value2;\n          setPostMeta(copyMeta);\n        } else {\n          var _value3 = e.target.value;\n          if (j == 'offer_type') {\n            if (_value3 == 'AggregateOffer') {\n              copyMeta[i]['properties']['high_price']['display'] = true;\n              copyMeta[i]['properties']['low_price']['display'] = true;\n              copyMeta[i]['properties']['offer_count']['display'] = true;\n              copyMeta[i]['properties']['offer_price']['display'] = false;\n            } else {\n              copyMeta[i]['properties']['high_price']['display'] = false;\n              copyMeta[i]['properties']['low_price']['display'] = false;\n              copyMeta[i]['properties']['offer_count']['display'] = false;\n              copyMeta[i]['properties']['offer_price']['display'] = true;\n            }\n          }\n          copyMeta[i]['properties'][j]['value'] = _value3;\n          setPostMeta(copyMeta);\n        }\n      }\n    }\n  };\n  var handleSaveForThePost = function handleSaveForThePost(i) {\n    var copyMeta = _toConsumableArray(postMeta);\n    copyMeta[i]['is_setup_popup'] = false;\n    setPostMeta(copyMeta);\n    setdataUpdated(function (prevState) {\n      return !prevState;\n    });\n  };\n  var savewholeSchemaGeneratorData = function savewholeSchemaGeneratorData() {\n    var body_json = {};\n    body_json.post_id = smpg_local.post_id;\n    body_json.tag_id = smpg_local.tag_id;\n    body_json.post_meta = postMeta;\n    var url = smpg_local.rest_url + 'smpg-route/save-post-meta';\n    fetch(url, {\n      method: \"post\",\n      headers: {\n        'Accept': 'application/json',\n        'Content-Type': 'application/json',\n        'X-WP-Nonce': smpg_local.nonce\n      },\n      body: JSON.stringify(body_json)\n    }).then(function (res) {\n      return res.json();\n    }).then(function (result) {}, function (error) {});\n  };\n  var handleChooseModalOpen = function handleChooseModalOpen() {\n    setChooseSchemaModal(true);\n  };\n  var handleChooseModalClose = function handleChooseModalClose() {\n    setChooseSchemaModal(false);\n    setSelectedSchema([]);\n  };\n  var handleChooseSchemaTypes = function handleChooseSchemaTypes(id) {\n    var copydata = _toConsumableArray(selectedSchema);\n    var index = copydata.indexOf(id);\n    if (index !== -1) {\n      copydata.splice(index, 1);\n    } else {\n      copydata.push(id);\n    }\n    setSelectedSchema(copydata);\n  };\n  var handleDeleteRepeater = function handleDeleteRepeater(e, i, j, elid) {\n    var copyMeta = _toConsumableArray(postMeta);\n    copyMeta[i]['properties'][j]['elements'].splice(elid, 1);\n    setPostMeta(copyMeta);\n  };\n  var handleAddMoreRepeater = function handleAddMoreRepeater(e, i, j) {\n    var copyMeta = _toConsumableArray(postMeta);\n    if (typeof copyMeta[i]['properties'][j]['elements'][0] !== \"undefined\") {\n      var new_element = copyMeta[i]['properties'][j]['elements'][0];\n      var fresh_element = [];\n      Object.keys(new_element).forEach(function (key) {\n        var obj = JSON.parse(JSON.stringify(new_element[key]));\n        obj['value'] = '';\n        fresh_element[key] = obj;\n      });\n      var new_obj = Object.assign({}, fresh_element);\n      copyMeta[i]['properties'][j]['elements'].push(JSON.parse(JSON.stringify(new_obj)));\n      setPostMeta(copyMeta);\n    } else {\n      var url = smpg_local.rest_url + \"smpg-route/get-repeater-element?schema_id=\" + copyMeta[i]['id'] + \"&element_name=\" + j;\n      fetch(url, {\n        headers: {\n          'X-WP-Nonce': smpg_local.nonce\n        }\n      }).then(function (res) {\n        return res.json();\n      }).then(function (result) {\n        if (result.status == 'success' && result.data) {\n          copyMeta[i]['properties'][j]['elements'].push(result.data);\n          setPostMeta(copyMeta);\n        }\n      }, function (error) {});\n    }\n  };\n  var getMetaData = function getMetaData(init) {\n    setChooseSchemaModal(false);\n    var body_json = {};\n    body_json.selected = selectedSchema;\n    body_json.post_id = smpg_local.post_id;\n    body_json.tag_id = smpg_local.tag_id;\n    body_json.init = init;\n    var url = smpg_local.rest_url + 'smpg-route/get-selected-schema-properties';\n    fetch(url, {\n      method: \"post\",\n      headers: {\n        'Accept': 'application/json',\n        'Content-Type': 'application/json',\n        'X-WP-Nonce': smpg_local.nonce\n      },\n      body: JSON.stringify(body_json)\n    }).then(function (res) {\n      return res.json();\n    }).then(function (result) {\n      if (result.status == 'success') {\n        var copyMeta = _toConsumableArray(postMeta);\n        Object.entries(result['properties']).map(function (_ref) {\n          var _ref2 = _slicedToArray(_ref, 2),\n            key = _ref2[0],\n            value = _ref2[1];\n          copyMeta.push(value);\n        });\n        setPostMeta(copyMeta);\n        if (!init) {\n          setdataUpdated(function (prevState) {\n            return !prevState;\n          });\n        }\n      }\n    }, function (error) {});\n    setSelectedSchema([]);\n  };\n  useEffect(function () {\n    getMetaData(true);\n  }, []);\n  useEffect(function () {\n    if (hasPageBeenRenderd.current[\"effect\"]) {\n      savewholeSchemaGeneratorData();\n    }\n    hasPageBeenRenderd.current[\"effect\"] = true;\n  }, [dataUpdated]);\n  return /*#__PURE__*/React.createElement(React.Fragment, null, /*#__PURE__*/React.createElement(\"div\", null, /*#__PURE__*/React.createElement(\"p\", {\n    className: \"smpg-description\"\n  }, __('Add schema types. Structured Data is used to display rich results in SERPs.', 'schema-package'))), postMeta.length > 0 ? /*#__PURE__*/React.createElement(\"div\", {\n    className: \"smpg-individual-schema-list\"\n  }, /*#__PURE__*/React.createElement(\"div\", null, /*#__PURE__*/React.createElement(\"h4\", null, __('Schema List', 'schema-package'))), /*#__PURE__*/React.createElement(\"ul\", null, postMeta.map(function (item, i) {\n    return /*#__PURE__*/React.createElement(\"li\", {\n      key: i\n    }, item.is_setup_popup && /*#__PURE__*/React.createElement(Modal, {\n      title: \"Edit \".concat(item.text),\n      shouldCloseOnClickOutside: false,\n      onRequestClose: function onRequestClose() {\n        return handleCloseModal(i, item.id);\n      }\n    }, /*#__PURE__*/React.createElement(\"div\", {\n      className: \"smpg-i-schema-setup\"\n    }, Object.entries(item.properties).map(function (_ref3) {\n      var _ref4 = _slicedToArray(_ref3, 2),\n        j = _ref4[0],\n        property = _ref4[1];\n      return /*#__PURE__*/React.createElement(\"div\", {\n        key: j,\n        className: \"smpg-property-fields\"\n      }, /*#__PURE__*/React.createElement(_shared_ElementGenerator_ElementGenerator__WEBPACK_IMPORTED_MODULE_2__[\"default\"], {\n        i: i,\n        j: j,\n        property: property,\n        handlePropertyChange: handlePropertyChange,\n        handleRemoveImage: handleRemoveImage,\n        handleDeleteRepeater: handleDeleteRepeater,\n        handleAddMoreRepeater: handleAddMoreRepeater\n      }));\n    })), /*#__PURE__*/React.createElement(Button, {\n      onClick: function onClick() {\n        return handleSaveForThePost(i);\n      },\n      isPrimary: true\n    }, __('Save For The Post', 'schema-package'))), item.has_warning ? /*#__PURE__*/React.createElement(\"span\", {\n      className: \"dashicons dashicons-warning smpg-i-warning-icon\"\n    }) : '', /*#__PURE__*/React.createElement(\"strong\", null, item.text), /*#__PURE__*/React.createElement(\"span\", {\n      className: \"smpg-individual-item-actions\"\n    }, item.is_delete_popup ? /*#__PURE__*/React.createElement(\"div\", {\n      className: \"smpg-delete-popover\"\n    }, /*#__PURE__*/React.createElement(\"span\", null, __('Delete ?', 'schema-package'), \" \"), /*#__PURE__*/React.createElement(Button, {\n      isLink: true,\n      onClick: function onClick() {\n        return handleSchemaDeleteYes(i, item.id);\n      }\n    }, __('Yes', 'schema-package')), \" : \", /*#__PURE__*/React.createElement(Button, {\n      isLink: true,\n      onClick: function onClick() {\n        return handleSchemaDeleteNo(i, item.id);\n      }\n    }, __('No', 'schema-package'))) : '', /*#__PURE__*/React.createElement(ToggleControl, {\n      checked: item.is_enable,\n      onChange: function onChange() {\n        return handleSchemaTurnOnOff(i, item.id);\n      }\n    }), /*#__PURE__*/React.createElement(Button, {\n      onClick: function onClick() {\n        return handleSchemaEdit(i, item.id);\n      }\n    }, /*#__PURE__*/React.createElement(\"span\", {\n      className: \"dashicons dashicons-edit-large\"\n    })), /*#__PURE__*/React.createElement(Button, {\n      onClick: function onClick() {\n        return handleSchemaDelete(i, item.id);\n      }\n    }, /*#__PURE__*/React.createElement(\"span\", {\n      className: \"dashicons dashicons-trash\"\n    }))));\n  }))) : null, /*#__PURE__*/React.createElement(\"div\", {\n    className: \"smpg-add-schema-action\"\n  }, /*#__PURE__*/React.createElement(\"div\", {\n    className: \"smpg-add-schema-select\"\n  }, chooseSchemaModal ? /*#__PURE__*/React.createElement(Modal, {\n    title: \"Choose Schema Types\",\n    shouldCloseOnClickOutside: false,\n    onRequestClose: handleChooseModalClose\n  }, /*#__PURE__*/React.createElement(\"div\", {\n    className: \"smpg-schema-list\"\n  }, /*#__PURE__*/React.createElement(\"div\", {\n    className: \"smpg-list-grid\"\n  }, _shared_schemaTypes__WEBPACK_IMPORTED_MODULE_1__.schemaTypes ? _shared_schemaTypes__WEBPACK_IMPORTED_MODULE_1__.schemaTypes.map(function (schema, l) {\n    return /*#__PURE__*/React.createElement(\"div\", {\n      key: l,\n      className: \"smpg-item-box \".concat(selectedSchema.includes(schema.value) ? 'smpg-item-box-selected' : ''),\n      onClick: function onClick() {\n        return handleChooseSchemaTypes(schema.value);\n      }\n    }, /*#__PURE__*/React.createElement(\"strong\", null, schema.text));\n  }) : '')), /*#__PURE__*/React.createElement(\"div\", {\n    className: \"smpg-choose-ok\"\n  }, /*#__PURE__*/React.createElement(Button, {\n    isPrimary: true,\n    onClick: function onClick() {\n      return getMetaData(false);\n    }\n  }, __('Selected', 'schema-package')))) : '', /*#__PURE__*/React.createElement(\"div\", null, /*#__PURE__*/React.createElement(Button, {\n    onClick: handleChooseModalOpen,\n    isPrimary: true\n  }, __('Choose Schema Types', 'schema-package'))))));\n};\nrender(/*#__PURE__*/React.createElement(Metabox, null), document.getElementById('smpg_individual_post_container'));\n\n//# sourceURL=webpack://smpg_admin/./individual/metabox.jsx?");

/***/ }),

/***/ "./shared/ElementGenerator/ElementGenerator.jsx":
/*!******************************************************!*\
  !*** ./shared/ElementGenerator/ElementGenerator.jsx ***!
  \******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"default\": () => (__WEBPACK_DEFAULT_EXPORT__)\n/* harmony export */ });\n/* harmony import */ var _ElementGenerator_css__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ElementGenerator.css */ \"./shared/ElementGenerator/ElementGenerator.css\");\nfunction _slicedToArray(r, e) { return _arrayWithHoles(r) || _iterableToArrayLimit(r, e) || _unsupportedIterableToArray(r, e) || _nonIterableRest(); }\nfunction _nonIterableRest() { throw new TypeError(\"Invalid attempt to destructure non-iterable instance.\\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.\"); }\nfunction _unsupportedIterableToArray(r, a) { if (r) { if (\"string\" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return \"Object\" === t && r.constructor && (t = r.constructor.name), \"Map\" === t || \"Set\" === t ? Array.from(r) : \"Arguments\" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }\nfunction _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }\nfunction _iterableToArrayLimit(r, l) { var t = null == r ? null : \"undefined\" != typeof Symbol && r[Symbol.iterator] || r[\"@@iterator\"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t[\"return\"] && (u = t[\"return\"](), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }\nfunction _arrayWithHoles(r) { if (Array.isArray(r)) return r; }\nvar __ = wp.i18n.__;\nvar _wp$components = wp.components,\n  BaseControl = _wp$components.BaseControl,\n  Button = _wp$components.Button,\n  ExternalLink = _wp$components.ExternalLink,\n  Panel = _wp$components.Panel,\n  PanelBody = _wp$components.PanelBody,\n  PanelRow = _wp$components.PanelRow,\n  Placeholder = _wp$components.Placeholder,\n  Spinner = _wp$components.Spinner,\n  ToggleControl = _wp$components.ToggleControl,\n  SelectControl = _wp$components.SelectControl,\n  Modal = _wp$components.Modal,\n  ComboboxControl = _wp$components.ComboboxControl,\n  Tooltip = _wp$components.Tooltip;\nvar _wp$element = wp.element,\n  render = _wp$element.render,\n  Component = _wp$element.Component,\n  Fragment = _wp$element.Fragment,\n  useState = _wp$element.useState,\n  useEffect = _wp$element.useEffect;\n\nvar ElementGenerator = function ElementGenerator(props) {\n  var propertyObj = props.property;\n  var createTypeText = function createTypeText(property, elid, tid, repeater) {\n    return /*#__PURE__*/React.createElement(\"div\", {\n      className: \"smpg-form-group\"\n    }, /*#__PURE__*/React.createElement(\"label\", null, property.label), /*#__PURE__*/React.createElement(\"input\", {\n      placeholder: property.placeholder,\n      onChange: function onChange(e) {\n        return props.handlePropertyChange(e, props.i, props.j, property.type, null, elid, tid, repeater);\n      },\n      type: \"text\",\n      className: \"smpg-form-control\",\n      value: property.value\n    }), /*#__PURE__*/React.createElement(\"p\", {\n      className: \"smpg-description\"\n    }, property.tooltip));\n  };\n  var createTypeMedia = function createTypeMedia(property, elid, tid, repeater) {\n    return /*#__PURE__*/React.createElement(\"div\", {\n      className: \"smpg-form-group\"\n    }, /*#__PURE__*/React.createElement(\"label\", null, property.label), /*#__PURE__*/React.createElement(\"br\", null), property.value.length > 0 ? /*#__PURE__*/React.createElement(\"div\", {\n      className: \"smpg-media-upload\"\n    }, /*#__PURE__*/React.createElement(\"div\", {\n      className: \"smpg-list-grid\"\n    }, property.value.map(function (img, k) {\n      return /*#__PURE__*/React.createElement(\"div\", {\n        key: k,\n        className: \"smpg-image-preview\"\n      }, /*#__PURE__*/React.createElement(\"img\", {\n        src: img.url\n      }), /*#__PURE__*/React.createElement(\"a\", {\n        href: \"#\",\n        onClick: function onClick(e) {\n          return props.handleRemoveImage(e, props.i, props.j, k, img.id, elid, tid, repeater);\n        }\n      }, \"X\"));\n    }))) : '', /*#__PURE__*/React.createElement(Button, {\n      className: \"smpg-upload-img-btn\",\n      onClick: function onClick(e) {\n        return props.handlePropertyChange(e, props.i, props.j, property.type, property.multiple, elid, tid, repeater);\n      },\n      isSecondary: true\n    }, \"Upload \".concat(property.label)), /*#__PURE__*/React.createElement(\"p\", {\n      className: \"smpg-description\"\n    }, property.tooltip));\n  };\n  var createTypeCheckbox = function createTypeCheckbox(property, elid, tid, repeater) {\n    return /*#__PURE__*/React.createElement(\"div\", {\n      className: \"smpg-form-group\"\n    }, /*#__PURE__*/React.createElement(\"label\", null, property.label), /*#__PURE__*/React.createElement(\"br\", null), /*#__PURE__*/React.createElement(\"input\", {\n      onChange: function onChange(e) {\n        return props.handlePropertyChange(e, props.i, props.j, property.type, null, elid, tid, repeater);\n      },\n      type: \"checkbox\",\n      className: \"smpg-form-control\",\n      checked: property.value\n    }), /*#__PURE__*/React.createElement(\"p\", {\n      className: \"smpg-description\"\n    }, property.tooltip));\n  };\n  var createTypeNumber = function createTypeNumber(property, elid, tid, repeater) {\n    return /*#__PURE__*/React.createElement(\"div\", {\n      className: \"smpg-form-group\"\n    }, /*#__PURE__*/React.createElement(\"label\", null, property.label), /*#__PURE__*/React.createElement(\"input\", {\n      placeholder: property.placeholder,\n      onChange: function onChange(e) {\n        return props.handlePropertyChange(e, props.i, props.j, property.type, null, elid, tid, repeater);\n      },\n      type: \"number\",\n      className: \"smpg-form-control\",\n      value: property.value\n    }), /*#__PURE__*/React.createElement(\"p\", {\n      className: \"smpg-description\"\n    }, property.tooltip));\n  };\n  var createTypeTextarea = function createTypeTextarea(property, elid, tid, repeater) {\n    return /*#__PURE__*/React.createElement(\"div\", {\n      className: \"smpg-form-group\"\n    }, /*#__PURE__*/React.createElement(\"label\", null, property.label), /*#__PURE__*/React.createElement(\"textarea\", {\n      placeholder: property.placeholder,\n      className: \"smpg-form-control\",\n      onChange: function onChange(e) {\n        return props.handlePropertyChange(e, props.i, props.j, property.type, null, elid, tid, repeater);\n      },\n      rows: \"4\",\n      value: property.value\n    }), /*#__PURE__*/React.createElement(\"p\", {\n      className: \"smpg-description\"\n    }, property.tooltip));\n  };\n  var createTypeSelect = function createTypeSelect(property, elid, tid, repeater) {\n    return /*#__PURE__*/React.createElement(\"div\", {\n      className: \"smpg-form-group\"\n    }, /*#__PURE__*/React.createElement(\"label\", null, property.label), /*#__PURE__*/React.createElement(\"select\", {\n      className: \"smpg-form-control\",\n      onChange: function onChange(e) {\n        return props.handlePropertyChange(e, props.i, props.j, property.type, null, elid, tid, repeater);\n      },\n      value: property.value\n    }, Object.entries(property.options).map(function (_ref) {\n      var _ref2 = _slicedToArray(_ref, 2),\n        key = _ref2[0],\n        value = _ref2[1];\n      return /*#__PURE__*/React.createElement(\"option\", {\n        value: key\n      }, value);\n    })), /*#__PURE__*/React.createElement(\"p\", {\n      className: \"smpg-description\"\n    }, property.tooltip));\n  };\n  var createTypeMultiSelect = function createTypeMultiSelect(property, elid, tid, repeater) {\n    return /*#__PURE__*/React.createElement(\"div\", {\n      className: \"smpg-form-group\"\n    }, /*#__PURE__*/React.createElement(\"label\", null, property.label), /*#__PURE__*/React.createElement(\"select\", {\n      multiple: true,\n      className: \"smpg-form-control\",\n      onChange: function onChange(e) {\n        return props.handlePropertyChange(e, props.i, props.j, property.type, null, elid, tid, repeater);\n      },\n      value: property.value\n    }, Object.entries(property.options).map(function (_ref3) {\n      var _ref4 = _slicedToArray(_ref3, 2),\n        key = _ref4[0],\n        value = _ref4[1];\n      return /*#__PURE__*/React.createElement(\"option\", {\n        value: key\n      }, value);\n    })), /*#__PURE__*/React.createElement(\"p\", {\n      className: \"smpg-description\"\n    }, property.tooltip));\n  };\n  return /*#__PURE__*/React.createElement(React.Fragment, null, function () {\n    if (propertyObj.display) {\n      var rcount = 0;\n      switch (propertyObj.type) {\n        case 'repeater':\n          return /*#__PURE__*/React.createElement(React.Fragment, null, /*#__PURE__*/React.createElement(Panel, {\n            className: \"smpg-repeater-panel\"\n          }, /*#__PURE__*/React.createElement(PanelBody, {\n            title: propertyObj.label,\n            initialOpen: true\n          }, propertyObj.elements.length > 0 ? propertyObj.elements.map(function (element, elid) {\n            rcount++;\n            return /*#__PURE__*/React.createElement(\"div\", {\n              className: \"smpg-repeater-panel-body\"\n            }, /*#__PURE__*/React.createElement(\"span\", {\n              className: \"smpg-repeater-i\"\n            }, rcount), /*#__PURE__*/React.createElement(\"span\", {\n              onClick: function onClick(e) {\n                return props.handleDeleteRepeater(e, props.i, props.j, elid);\n              },\n              className: \"dashicons dashicons-trash smpg-trash-repeater\"\n            }), Object.entries(element).map(function (_ref5) {\n              var _ref6 = _slicedToArray(_ref5, 2),\n                tid = _ref6[0],\n                tags = _ref6[1];\n              if (tags.display) {\n                switch (tags.type) {\n                  case 'number':\n                    return createTypeNumber(tags, elid, tid, 'repeater');\n                  case 'textarea':\n                    return createTypeTextarea(tags, elid, tid, 'repeater');\n                  case 'media':\n                    return createTypeMedia(tags, elid, tid, 'repeater');\n                  case 'select':\n                    return createTypeSelect(tags, elid, tid, 'repeater');\n                  case 'checkbox':\n                    return createTypeCheckbox(tags, elid, tid, 'repeater');\n                  default:\n                    return createTypeText(tags, elid, tid, 'repeater');\n                }\n              }\n            }));\n          }) : '', /*#__PURE__*/React.createElement(\"div\", null, /*#__PURE__*/React.createElement(Button, {\n            onClick: function onClick(e) {\n              return props.handleAddMoreRepeater(e, props.i, props.j);\n            },\n            isSecondary: true\n          }, propertyObj.button_text)))));\n        case 'select':\n          return createTypeSelect(propertyObj, null, null, null);\n        case 'multiselect':\n          return createTypeMultiSelect(propertyObj, null, null, null);\n        case 'textarea':\n          return createTypeTextarea(propertyObj, null, null, null);\n        case 'media':\n          return createTypeMedia(propertyObj, null, null, null);\n        case 'number':\n          return createTypeNumber(propertyObj, null, null, null);\n        case 'checkbox':\n          return createTypeCheckbox(propertyObj, null, null, null);\n        default:\n          return createTypeText(propertyObj, null, null, null);\n      }\n    }\n  }());\n};\n/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (ElementGenerator);\n\n//# sourceURL=webpack://smpg_admin/./shared/ElementGenerator/ElementGenerator.jsx?");

/***/ }),

/***/ "./shared/schemaTypes.jsx":
/*!********************************!*\
  !*** ./shared/schemaTypes.jsx ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   schemaTypes: () => (/* binding */ schemaTypes)\n/* harmony export */ });\nvar schemaTypes = [{\n  key: 0,\n  value: 'article',\n  text: 'Article'\n}, {\n  key: 1,\n  value: 'product',\n  text: 'Product'\n}, {\n  key: 2,\n  value: 'softwareapplication',\n  text: 'SoftwareApplication'\n}, {\n  key: 3,\n  value: 'book',\n  text: 'Book'\n}, {\n  key: 4,\n  value: 'faqpage',\n  text: 'FAQs'\n}, {\n  key: 5,\n  value: 'howto',\n  text: 'HowTo'\n}, {\n  key: 6,\n  value: 'qna',\n  text: 'Q&A'\n}, {\n  key: 7,\n  value: 'event',\n  text: 'Event'\n}, {\n  key: 8,\n  value: 'recipe',\n  text: 'Recipe'\n}, {\n  key: 9,\n  value: 'videoobject',\n  text: 'VideoObject'\n}, {\n  key: 10,\n  value: 'course',\n  text: 'Course'\n}, {\n  key: 11,\n  value: 'jobposting',\n  text: 'JobPosting'\n}, {\n  key: 12,\n  value: 'localbusiness',\n  text: 'LocalBusiness'\n}, {\n  key: 13,\n  value: 'service',\n  text: 'Service'\n}];\n\n//# sourceURL=webpack://smpg_admin/./shared/schemaTypes.jsx?");

/***/ }),

/***/ "./individual/style/common.css":
/*!*************************************!*\
  !*** ./individual/style/common.css ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n// extracted by mini-css-extract-plugin\n\n\n//# sourceURL=webpack://smpg_admin/./individual/style/common.css?");

/***/ }),

/***/ "./shared/ElementGenerator/ElementGenerator.css":
/*!******************************************************!*\
  !*** ./shared/ElementGenerator/ElementGenerator.css ***!
  \******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n// extracted by mini-css-extract-plugin\n\n\n//# sourceURL=webpack://smpg_admin/./shared/ElementGenerator/ElementGenerator.css?");

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
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = __webpack_require__("./individual/metabox.jsx");
/******/ 	
/******/ })()
;
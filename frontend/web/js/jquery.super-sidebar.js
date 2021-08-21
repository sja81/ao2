/*!
 * Super Sidebar v2.2
 * (c) CreativeTier
 * contact@creativetier.com
 * http://www.creativetier.com
 */
(function($) {
"use strict";

var PAGE_URL = encodeURIComponent(document.location.href);
var PAGE_TITLE = encodeURIComponent(document.title);

var shareServices = {
	"facebook": {
		url: "https://facebook.com/sharer/sharer.php?u={URL}",
		target: "popup",
		popup: {"width": 700, "height": 450, "top": 150, "left": "center"}
	},
	"twitter": {
		url: "https://twitter.com/share?url={URL}&text={TITLE}",
		target: "popup",
		popup: {"width": 700, "height": 450, "top": 150, "left": "center"}
	},
	"google-plus": {
		url: "https://plus.google.com/share?url={URL}",
		target: "popup",
		popup: {"width": 700, "height": 450, "top": 150, "left": "center"}
	},
	"linkedin": {
		url: "https://www.linkedin.com/shareArticle?url={URL}&title={TITLE}",
		target: "popup",
		popup: {"width": 700, "height": 450, "top": 150, "left": "center"}
	},
	"pinterest": {
		file: "https://assets.pinterest.com/js/pinmarklet.js"
	},
	"xing": {
		url: "https://www.xing.com/spi/shares/new?url={URL}",
		target: "popup",
		popup: {"width": 700, "height": 450, "top": 150, "left": "center"}
	},
	"myspace": {
		url: "https://myspace.com/post?u={URL}&t={TITLE}",
		target: "popup",
		popup: {"width": 700, "height": 450, "top": 150, "left": "center"}
	},
	"vk": {
		url: "http://vk.com/share.php?url={URL}",
		target: "popup",
		popup: {"width": 700, "height": 450, "top": 150, "left": "center"}
	},
	"weibo": {
		url: "http://service.weibo.com/share/share.php?url={URL}&title={TITLE}",
		target: "popup",
		popup: {"width": 700, "height": 450, "top": 150, "left": "center"}
	},
	"buffer": {
		url: "https://buffer.com/add?text={TITLE}&url={URL}",
		target: "popup",
		popup: {"width": 700, "height": 450, "top": 150, "left": "center"}
	},
	"stumbleupon": {
		url: "http://www.stumbleupon.com/submit?url={URL}&title={TITLE}",
		target: "popup",
		popup: {"width": 700, "height": 450, "top": 150, "left": "center"}
	},
	"reddit": {
		url: "http://www.reddit.com/submit?url={URL}&title={TITLE}",
		target: "popup",
		popup: {"width": 900, "height": 500, "top": 150, "left": "center"}
	},
	"tumblr": {
		url: "https://www.tumblr.com/widgets/share/tool?canonicalUrl={URL}&title={TITLE}",
		target: "popup",
		popup: {"width": 700, "height": 450, "top": 150, "left": "center"}
	},
	"blogger": {
		url: "https://www.blogger.com/blog-this.g?u={URL}&n={TITLE}",
		target: "popup",
		popup: {"width": 700, "height": 450, "top": 150, "left": "center"}
	},
	"livejournal": {
		url: "http://www.livejournal.com/update.bml?subject={TITLE}&event={URL}",
		target: "popup",
		popup: {"width": 800, "height": 550, "top": 150, "left": "center"}
	},
	"pocket": {
		url: "https://getpocket.com/save?url={URL}",
		target: "popup",
		popup: {"width": 700, "height": 450, "top": 150, "left": "center"}
	},
	"telegram": {
		url: "https://telegram.me/share/url?url={URL}&text={TITLE}",
		target: "popup",
		popup: {"width": 700, "height": 450, "top": 150, "left": "center"}
	},
	"skype": {
		url: "https://web.skype.com/share?url={URL}",
		target: "popup",
		popup: {"width": 700, "height": 550, "top": 150, "left": "center"}
	},
	"whatsapp": {
		url: "whatsapp://send?text={URL}",
		target: "app"
	},
	"messenger": {
		url: "fb-messenger://share?link={URL}",
		target: "app"
	}
};

var defaults = {
	// Main
	position: ["left", "center"],
	offset: [0, 0],
	buttonShape: "round",
	buttonColor: "custom",
	buttonOverColor: "custom",
	iconColor: "white",
	iconOverColor: "white",
	labelColor: "match",
	labelTextColor: "match",
	labelEffect: "slide-out-fade",
	labelAnimate: "default",
	labelConnected: false,
	labelsOn: true,
	sideSpace: false,
	buttonSpace: false,
	labelSpace: false,
	// Subbar
	subPosition: ["circular", 100, -90, 90],
	subEffect: ["slide", 30],
	subAnimate: [400, "easeOutQuad"],
	subSpace: false,
	subOpen: "mouseover",
	// Window
	windowPosition: ["center", "center"],
	windowOffset: [0, 0],
	windowCorners: "match",
	windowColor: "match",
	windowShadow: true,
	// Other
	showAfterPosition: false,
	barAnimate: [250, "easeOutQuad"],
	hideUnderWidth: false,
	shareTarget: "default",
	// Animate
	animateEngine: "velocity"
};
var labelAnimateDefaults = {
	"default": [400, "easeOutQuad"],
	"fade": [200, "easeOutQuad"],
	"slide-in-in": {
		show: [400, "easeOutQuad"],
		hide: [400, "swing"]
	}
};

var formMessages = {
	empty: "Please fill all of the required fields.",
	badEmail: "The email format is incorrect.",
	working: "Working, please wait...",
	success: "The submission was successful!",
	error: "There was an error! Please try again.",
	noFile: "Form processing file not found."
};

var methods = {
	"build": build,
	"destroy": destroy
};

$.fn.superSidebar = function(arg) {
	if (typeof arg === "object" || !arg) {
		build.apply(this, arguments);
	} else if (methods[arg]) {
		methods[arg].apply(this, Array.prototype.slice.call(arguments, 1));
	} else {
		$.error("The method " + arg + " does not exist in Super Sidebar.");
	}
};

function build(options) {
	var settings = createSettings(options);

	return this.each(function() {
		var sidebar = $(this);

		if (sidebar.data("sb-built")) destroy.apply(this);
		sidebar.data("sb-built", true);

		// VARS
		var bar = sidebar.children(".sb-bar");
		var barList = bar.children();
		var sbwindow = sidebar.children(".sb-window");

		var $window = $(window);
		var $document = $(document);

		var barVisible = true;
		var right = false;
		var csub = null;
		var cwindow = null;
		var nextMargins = [];


		// INIT
		if (settings.position[0] === "right") {
			right = true;
			bar.addClass("sb-right");
		}

		if (settings.buttonShape !== "square") bar.addClass("sb-" + settings.buttonShape);

		if (settings.labelConnected) bar.addClass("sb-connected");

		if (settings.buttonColor !== "custom") bar.addClass("sb-" + settings.buttonColor + "-button");
		if (settings.buttonOverColor !== "custom") bar.addClass("sb-" + settings.buttonOverColor + "-button-over");

		if (settings.iconColor !== "custom") bar.addClass("sb-" + settings.iconColor + "-icon");
		if (settings.iconOverColor !== "custom") bar.addClass("sb-" + settings.iconOverColor + "-icon-over");

		if (settings.labelColor !== "custom") bar.addClass("sb-" + settings.labelColor + "-label");
		if (settings.labelTextColor !== "custom") bar.addClass("sb-" + settings.labelTextColor + "-label-text");
		
		if (settings.sideSpace) bar.addClass("sb-side-space");
		if (settings.buttonSpace) bar.addClass("sb-button-space");
		if (settings.labelSpace) bar.addClass("sb-label-space");

		if (settings.windowCorners === "round") sbwindow.addClass("sb-round");
		if (settings.windowColor !== "custom") sbwindow.addClass("sb-" + settings.windowColor);
		if (settings.windowShadow) sbwindow.addClass("sb-winshadow");

		
		buildList(bar);

		// Subbar animate fix.
		barList.each(function(ind) {
			nextMargins[ind] = getInt(barList.eq(ind).css("margin-top"));
		});

		sbwindow.children(".sb-shadow").on("click", closeWindow);

		sbwindow.children(".sb-panel").each(buildPanel);

		resize();

		$window.on("resize.superSidebar", resize);

		if (settings.showAfterPosition) {
			if ($window.scrollTop() < settings.showAfterPosition) {
				bar.css("opacity", 0).addClass("sb-hide");
				barVisible  = false;
			}

			$window.on("scroll.superSidebar", function() {
				if ($window.scrollTop() < settings.showAfterPosition) {
					if (barVisible) hideBar();
				} else {
					if (!barVisible) showBar();
				}
			});
		}

		bar.addClass("sb-css-anim");

		sidebar.addClass("sb-ready");


		// FUNCTIONS
		function buildList(list) {
			list.children().each(function(i) {
				if ($(this).hasClass("sb-sub")) buildSub(this, i);
				else buildButton(this);
			});
		}

		function buildButton(btn) {
			var button = $(btn);
			var link = button.children("a");
			var icon = link.children(".sb-icon");
			var label = link.children(".sb-label");
			var mask, hit = null;

			var maskHtml = '<div class="sb-mask"></div>';
			var hitHtml = '<div class="sb-hit"></div>';

			var iw, lw;
			var side = right ? "right" : "left";
			var dist = 40;
			var maskOff = false;
			var start = {}, show = {}, end = {};
			var showLabel, hideLabel;

			var showTime = settings.labelAnimate.show[0];
			var showEase = settings.labelAnimate.show[1];
			var hideTime = settings.labelAnimate.hide[0];
			var hideEase = settings.labelAnimate.hide[1];

			if (settings.labelsOn && label.length) {
				iw = getInt(icon.css("width"));
				lw = label.outerWidth(true);

				if (settings.buttonShape === "round" || settings.buttonShape === "rounded") maskOff = true;

				if (!settings.labelConnected && (settings.labelSpace || settings.buttonShape === "round" || settings.buttonShape === "rounded" || settings.buttonShape === "rounded-out"))
					hit = $(hitHtml).appendTo(link);

				switch (settings.labelEffect) {
					case "fade":
						start = {"opacity": 0};
						show = {"opacity": 1};

						label.css(start);

						showLabel = function() {
							if (hit) hit.addClass("sb-show");
							
							stopAnimate(label);
							label.addClass("sb-show");
							animate(label, show, showTime, showEase);
						};
						hideLabel = function() {
							stopAnimate(label);
							animate(label, start, hideTime, hideEase, function() {
								label.removeClass("sb-show");
								if (hit) hit.removeClass("sb-show");
							});
						};
						break;
					case "slide-out":
					case "slide-out-fade":
						mask = link.wrap(maskHtml).parent();
						mask.css("width", iw);
						if (maskOff) mask.addClass("sb-off");

						start[side] = -lw + iw;
						if (settings.labelConnected) show[side] = 0;
						else show[side] = iw;

						if (settings.labelEffect === "slide-out-fade") {
							start["opacity"] = 0;
							show["opacity"] = 1;
						}

						label.css(start);

						showLabel = function() {
							mask.css("width", iw + lw);
							if (maskOff) mask.removeClass("sb-off");
							if (hit) hit.addClass("sb-show");
							
							stopAnimate(label);
							label.addClass("sb-show");
							animate(label, show, showTime, showEase);
						};
						hideLabel = function() {
							stopAnimate(label);
							animate(label, start, hideTime, hideEase, function() {
								label.removeClass("sb-show");
								mask.css("width", iw);
								if (maskOff) mask.addClass("sb-off");
								if (hit) hit.removeClass("sb-show");
							});
						};
						break;
					case "slide-in":
						start = {"opacity": 0};
						start[side] = iw + dist;
						show = {"opacity": 1};
						show[side] = iw;

						label.css(start);

						showLabel = function() {
							if (hit) hit.addClass("sb-show");

							stopAnimate(label);
							label.addClass("sb-show");
							animate(label, show, showTime, showEase);
						};
						hideLabel = function() {
							stopAnimate(label);
							animate(label, start, hideTime, hideEase, function() {
								label.removeClass("sb-show");
								if (hit) hit.removeClass("sb-show");
							});
						};
						break;
					case "slide-out-out":
					case "slide-in-in":
						mask = link.wrap(maskHtml).parent();
						mask.css("width", iw);
						if (maskOff) mask.addClass("sb-off");

						if (settings.labelEffect === "slide-out-out") {
							start[side] = -lw + iw;
							show[side] = iw;
							end[side] = iw + dist;
						} else {
							start[side] = iw + dist;
							show[side] = iw;
							end[side] = -lw + iw;
						}
						start["opacity"] = 0;
						show["opacity"] = 1;
						end["opacity"] = 0;

						showLabel = function() {
							mask.css("width", iw + lw + dist);
							if (maskOff) mask.removeClass("sb-off");
							if (hit) hit.addClass("sb-show");

							stopAnimate(label);
							label.css(start).addClass("sb-show");
							animate(label, show, showTime, showEase, function() {
								mask.css("width", iw + lw);
							});
						};
						hideLabel = function() {
							mask.css("width", iw + lw + dist);
							stopAnimate(label);
							animate(label, end, hideTime, hideEase, function() {
								label.removeClass("sb-show");
								mask.css("width", iw);
								if (maskOff) mask.addClass("sb-off");
								if (hit) hit.removeClass("sb-show");
							});
						};
						break;
					default:
						showLabel = function() {
							if (hit) hit.addClass("sb-show");
							label.addClass("sb-show");
						};
						hideLabel = function() {
							label.removeClass("sb-show");
							if (hit) hit.removeClass("sb-show");
						};
						break;
				}

				link.on("mouseenter", showLabel);
				link.on("mouseleave", hideLabel);
			}

			
			var shareVal = link.data("share");
			var shareData;
			var shareUrl;
			var shareTarget;
			var href;

			if (shareVal) {
				if (shareVal === "pinterest") {
					link.on("click", pinterestShare);
				} else {
					shareData = settings.shareServices[shareVal];

					if (shareData) {
						shareUrl = shareData.url.replace("{URL}", PAGE_URL)
												.replace("{TITLE}", PAGE_TITLE);
						
						link.attr("href", shareUrl);

						if (shareData.target === "app") {
							link.attr("target", "_self");
						} else {
							if (settings.shareTarget === "default") shareTarget = shareData.target;
							else shareTarget = settings.shareTarget;

							if (shareTarget === "popup") {
								link.on("click", {"url": shareUrl, "params": shareData.popup}, sharePopup);
							} else {
								link.attr("target", "_blank");
							}
						}
					} else {
						warn('There is no share data for "' + shareVal + '".');
					}
				}
			} else {
				href = link.attr("href");

				if (href && href.charAt(0) === "#" && href !== "#") {
					link.on("click", function() {
						openWindow(href);
						return false;
					});
				}
			}
		}

		function buildSub(sub, ind) {
			var sub = $(sub);
			var icon = sub.children(".sb-icon");
			var list = sub.children("ul");
			var buttonList = list.children();
			var hit = null;
			var nextButton = null;

			var hitHtml = '<div class="sb-subhit"></div>';

			var position = settings.subPosition[0];
			var effect = settings.subEffect[0];
			var side = right ? "right" : "left";
			var total = buttonList.length;
			var iw = getInt(icon.css("width"));
			var ih = getInt(icon.css("height"));
			var positions = [];
			var status = null;
			var start = {}, show = {};
			var interval;
			var showList, hideList;
			var i;
			var nextOffset = 0;
			var prevOffset = 0;
			var nextMargin;
			var buttonMargin;
			var barMargin;
			var subOpen = false;

			var showTime = settings.subAnimate.show[0];
			var showEase = settings.subAnimate.show[1];
			var hideTime = settings.subAnimate.hide[0];
			var hideEase = settings.subAnimate.hide[1];

			
			buildList(list);

			if (position === "side") sub.addClass("sb-side");
			if (settings.subSpace) sub.addClass("sb-sub-space");

			if (effect === "linear-slide" || position === "circular")
				sub.addClass("sb-posabs");

			if ((position === "under" && effect === "linear-slide") ||
				(position === "circular" && effect === "slide") ||
				(position === "circular" && effect === "linear-slide")) {
				buttonList.each(function(i) {
					$(this).css("z-index", 100 - i);
				});
			}

			if (barList[ind + 1]) {
				nextButton = barList.eq(ind + 1);
				//nextMargin = getInt(nextButton.css("margin-top"));
			}

			if (position === "circular") {
				sub.addClass("sb-circular");

				var r = settings.subPosition[1];
				var sa = settings.subPosition[2];
				var ea = settings.subPosition[3];

				var startRad = sa * Math.PI / 180;
				var endRad = ea * Math.PI / 180;
				var stepRad = (endRad - startRad) / (total - 1);
				var a, s, t, p;
				
				buttonList.each(function(i) {
					a = i * stepRad + startRad;
					s = Math.round(r * Math.cos(a));
					t = Math.round(r * Math.sin(a));

					p = {"top": t};
					p[side] = s;
					$(this).css(p);
					positions[i] = [s, t];
				});

				hit = $(hitHtml).appendTo(sub);
				hit.css({
					"width": r + iw,
					"height": 2 * r + iw,
					"border-radius": right ? r + "px 0 0 " + r + "px" : "0 " + r + "px " + r + "px 0",
					"top": -r
				});

				buttonMargin = getInt(barList.eq(0).css("margin-bottom"));

				if (ind !== 0) {
					prevOffset = r + buttonMargin;
					barMargin = getInt(bar.css("margin-top"));
					sub.css("margin-top", buttonMargin);
				}

				if (nextButton) {
					nextOffset = r + buttonMargin;
				}
			} else {
				if (effect === "linear-slide") {
					var c = 0;
					buttonList.each(function(i) {
						var btn = $(this);
						btn.css("top", c);
						positions[i] = c;
						c += getInt(btn.css("height")) + getInt(btn.css("margin-bottom"));
					});

					list.css({"width": iw, "height": c});
				}

				hit = $(hitHtml).appendTo(sub);
				if (position === "side")
					hit.css({"width": iw + getInt(list.css("margin-" + side)), "height": ih});
				else
					hit.css({"width": iw, "height": ih + getInt(list.css("margin-top"))});

				if (position === "under" && nextButton) {
					nextOffset = list.outerHeight(true) + getInt(nextButton.css("margin-top")) + getInt(list.css("margin-top"));
				}
			}


			list.addClass("sb-hide");

			switch (effect) {
				case "fade":
					start = {"opacity": 0};
					show = {"opacity": 1};

					list.css(start);

					showList = function() {
						stopAnimate(list);
						list.removeClass("sb-hide");
						animate(list, show, showTime, showEase);
					};
					hideList = function() {
						stopAnimate(list);
						animate(list, start, hideTime, hideEase, function() {
							list.addClass("sb-hide");
						});
					};
					break;
				case "slide":
					if (position === "circular") {
						start = {"top": 0, "opacity": 0};
						start[side] = 0;
						buttonList.css(start);

						showList = function() {
							list.removeClass("sb-hide");
							buttonList.each(function(i) {
								var button = $(this);

								show = {"top": positions[i][1], "opacity": 1};
								show[side] = positions[i][0];
								
								stopAnimate(button);
								animate(button, show, showTime, showEase);
							});
						};
						hideList = function() {
							buttonList.each(function(i) {
								var button = $(this);

								stopAnimate(button);
								animate(button, start, hideTime, hideEase, function() {
									if (i === total - 1) list.addClass("sb-hide");
								});
							});
						};
					} else {
						if (position === "side") {
							start[side] = 0;
							show[side] = iw;
						} else {
							start = {"top": 0};
							show = {"top": 42};
						}
						start["opacity"] = 0;
						show["opacity"] = 1;

						list.css(start);

						showList = function() {
							stopAnimate(list);
							list.removeClass("sb-hide");
							animate(list, show, showTime, showEase);
						};
						hideList = function() {
							stopAnimate(list);
							animate(list, start, hideTime, hideEase, function() {
								list.addClass("sb-hide");
							});
						};
					}
					break;
				case "linear-fade":
					start = {"opacity": 0};
					show = {"opacity": 1};

					buttonList.css(start);

					showList = function() {
						status="show";
						list.removeClass("sb-hide");
						stopInterval();
						i = 0;
						interval = setInterval(function() {
							var button = buttonList.eq(i);

							stopAnimate(button);
							animate(button, show, showTime, showEase);

							if (i === total - 1) stopInterval();
							else i++;
						}, settings.subEffect[1]);
					};
					hideList = function() {
						status="hide";
						stopInterval();
						i = total - 1;
						interval = setInterval(function() {
							var bi = i;
							var button = buttonList.eq(i);

							stopAnimate(button);
							animate(button, start, showTime, showEase, function() {
								if (status === "hide" && bi === 0) list.addClass("sb-hide");
							});

							if (i === 0) stopInterval();
							else i--;
						}, settings.subEffect[1]);
					};
					break;
				case "linear-slide":
					var first, last, step;

					if (position === "side") start[side] = -iw;	
					else if (position === "circular") {
						start = {"top": 0};
						start[side] = 0;
					} else start = {"top": -ih};
					start["opacity"] = 0;

					buttonList.css(start);
					
					showList = function() {
						status = "show";
						list.removeClass("sb-hide");
						stopInterval();
						i = 0;
						interval = setInterval(function() {
							var button = buttonList.eq(i);

							if (position === "side") show[side] = 0;
							else if (position === "circular") {
								show = {"top": positions[i][1]};
								show[side] = positions[i][0];
							} else show = {"top": positions[i]};
							show["opacity"] = 1;

							stopAnimate(button);
							animate(button, show, showTime, showEase);

							if (i === total - 1) stopInterval();
							else i++;
						}, settings.subEffect[1]);
					};
					hideList = function() {
						status = "hide";

						if (position === "side" || position === "circular") {
							first = 0;
							last = total - 1;
							step = 1;
						} else {
							first = total - 1;
							last = 0;
							step = -1;
						}
						
						stopInterval();
						i = first;
						interval = setInterval(function() {
							var bi = i;
							var button = buttonList.eq(i);
							
							stopAnimate(button);
							animate(button, start, showTime, showEase, function() {
								if (status === "hide" && bi === last) list.addClass("sb-hide");
							});

							if (i === last) stopInterval();
							else i += step;
						}, settings.subEffect[1]);
					};
					break;
				default:
					showList = function() {
						list.removeClass("sb-hide");
					};
					hideList = function() {
						list.addClass("sb-hide");
					};
					break;
			}

			function stopInterval() {
				clearInterval(interval);
			}

			function showSub() {
				showList();
				if (hit) hit.addClass("sb-show");

				if (prevOffset) {
					stopAnimate(bar);
					animate(bar, {"margin-top": barMargin - prevOffset + buttonMargin}, showTime, showEase);
					
					stopAnimate(sub);
					animate(sub, {"margin-top": prevOffset}, showTime, showEase);
				}

				if (nextOffset) {
					stopAnimate(nextButton);
					animate(nextButton, {"margin-top": nextOffset}, showTime, showEase);
				}

				subOpen = true;
				csub = sub;
			}

			function hideSub() {
				hideList();
				if (hit) hit.removeClass("sb-show");

				if (prevOffset) {
					stopAnimate(bar);
					animate(bar, {"margin-top": barMargin}, showTime, showEase);
					
					stopAnimate(sub);
					animate(sub, {"margin-top": buttonMargin}, showTime, showEase);
				}

				if (nextOffset) {
					stopAnimate(nextButton);
					animate(nextButton, {"margin-top": nextMargins[ind + 1]}, showTime, showEase);
				}

				subOpen = false;
				csub = null;
			}

			sub.show = showSub;
			sub.hide = hideSub;

			if (settings.subOpen === "click") {
				icon.on("click", function(event) {
					if (subOpen) {
						hideSub();
					} else {
						if (csub) {
							csub.hide();
						}
						showSub();
					}
					event.stopPropagation();
				});

				$document.on("click", function(event) {
					if (subOpen && !cwindow && !$(event.target).closest(sub).length) {
						hideSub();
					}
				});
			} else {
				sub.on("mouseenter", showSub);
				sub.on("mouseleave", hideSub);
			}
		}

		function buildPanel() {
			var panel = $(this);
			panel.find(".sb-close").on("click", function(event) {
				closeWindow();
				event.stopPropagation();
			});

			var form = panel.find(".sb-form");
			if (form.length) {
				buildForm(form);
			}
		}

		function buildForm(form) {
			var fieldList = form.find("input, textarea, select");
			var submitBtn = form.find(".sb-submit");
			var status = form.find(".sb-status");
			var statusIcon, statusMsg;

			var formData;
			var working = false;
			var statusClass = null;

			if (form.data("id") && settings.formData && settings.formData[form.data("id")]) {
				formData = settings.formData[form.data("id")];
				formData.status = $.extend({}, formMessages, formData.status);
			} else {
				formData = {status: formMessages};
			}

			statusIcon = $('<div class="sb-sicon"></div>');
			status.append(statusIcon);

			statusMsg = $(' <div class="sb-message"></div>');
			status.append(statusMsg);

			submitBtn.on("click", trySubmit);

			form.on("submit", function(event) {
				trySubmit();
				event.preventDefault();
			});

			function trySubmit() {
				if (!working) {
					validateForm();
				}
			}
			function validateForm() {
				var valid = true;
				var error = null;

				fieldList.each(function() {
					var field = $(this);
					var fvalid = true;
					
                    if(field.attr("id") === "newsletter_allowpt" &&  !field.is(':checked')){
                        valid = fvalid = false;
                        if (!error) error = "consent";
                    }
                    else if(field.attr("id") === "contactform_allowpt" &&  !field.is(':checked')){
                        valid = fvalid = false;
                        if (!error) error = "consent";
                    }
                    else if (field.attr("required") && field.val() === "") {
						valid = fvalid = false;
						if (!error) error = "empty";
					}
					else if (field.attr("name") === "email" && !validateEmail(field.val())) {
						valid = fvalid = false;
						if (!error) error = "badEmail";
					}

					if (!fvalid) {
						field.addClass("sb-fielderror");
						field.on("focus", function() {
							$(this).removeClass("sb-fielderror").off("focus");
						});
					}
				});

				if (valid) {
					submitForm();
					showStatus("working");
				} else {
					showStatus(error);
				}
			}

			function submitForm() {
				var submitData;

				working = true;
				
				submitData = form.serializeArray();

				if (formData.post) {
					$.each(formData.post, function(key, val) {
						var obj = {};
						obj[key] = val;
						submitData.push(obj);
					});
				}

				$.ajax({
					type: "POST",
					url: form.attr("action"),
					data: submitData,
					dataType: "json",
					success: function(data) {
						if (data.status) {
							showStatus("success", data.message);
							clearForm();
						} else {
							showStatus("error", data.message);
						}
						working = false;
					},
					error: function(jqXHR, textStatus, errorThrown) {
						var msg = errorThrown === "Not Found" ? formData.status.noFile : errorThrown;
						showStatus("error", msg);
						working = false;
					}
				});
			}

			function clearForm() {
				fieldList.each(function() {
					$(this).val("");
				});
			}

			function showStatus(type, msg) {
				status.removeClass(statusClass);
				switch (type) {
					case "empty":
					case "badEmail":
					case "error":
						statusClass = "sb-error";
						break;
					case "working":
						statusClass = "sb-working";
						break;
					case "success":
						statusClass = "sb-success";
						break;
				}
				status.addClass(statusClass);
				
				if (msg) {
					statusMsg.text(msg);
				} else {
					statusMsg.text(formData.status[type]);
				}
				
				status.addClass("sb-show");
			}
		}

		function openWindow(name) {
			sbwindow.addClass("sb-show");
			cwindow = $(name).addClass("sb-show");
			posWindow(cwindow);
		}
		function closeWindow() {
			sbwindow.removeClass("sb-show");
			cwindow.removeClass("sb-show");
			cwindow = null;
		}

		function position() {
			posBar();
			if (cwindow) posWindow(cwindow);
		}

		function resize() {
			position();

			if (settings.hideUnderWidth) {
				if ($window.width() < settings.hideUnderWidth) {
					sidebar.addClass("sb-vhide");
				} else {
					sidebar.removeClass("sb-vhide");
				}
			}
		}

		function posBar () {
			posObject(bar, settings.position, settings.offset);
		}
		function posWindow(win) {
			var pos, off;

			if (win.data("position")) {
				pos = win.data("position").split("-");
				if (!pos[1]) pos[1] = defaults.windowPosition[1];
			} else {
				pos = settings.windowPosition;
			}

			if (win.data("offset")) {
				off = splitOffset(win.data("offset"));
			} else {
				off = settings.windowOffset;
			}

			posObject(win, pos, off);
		}
		function posObject(tar, pos, off) {
			if (pos) {
				var ww = $window.width();
				var wh = $window.height();
				var tw = tar.outerWidth(true);
				var th = tar.outerHeight(true);
				var x, y;
				var p;

				if (typeof pos[0] === "number") x = {"left": pos[0] + off[0]};
				else if (typeof pos[0] === "string") {
					if (pos[0].indexOf("%") !== -1) {
						p = getInt(pos[0].split("%")[0]);
						x = {"left": p / 100 * ww + off[0]};
					} else {
						if (pos[0] === "left") x = {"left": 0 + off[0]};
						else if (pos[0] === "center") x = {"left": (ww - tw) / 2 + off[0]};
						else if (pos[0] === "right") x = {"right": 0 + off[0]};

						else x = {"left": getInt(pos[0]) + off[0]};
					}
				}

				if (typeof pos[1] === "number") y = {"top": pos[1] + off[1]};
				else if (typeof pos[1] === "string") {
					if (pos[1].indexOf("%") !== -1) {
						p = getInt(pos[1].split("%")[0]);
						y = {"top": p / 100 * wh + off[1]};
					} else {
						if (pos[1] === "top") y = {"top": 0 + off[1]};
						else if (pos[1] === "center") y = {"top": (wh - th) / 2 + off[1]};
						else if (pos[1] === "bottom") y = {"bottom": 0 + off[1]};

						else y = {"top": getInt(pos[1]) + off[1]};
					}
				}
				
				if (x.left) x.left = Math.round(x.left);
				if (x.right) x.right = Math.round(x.right);

				if (y.top) y.top = Math.round(y.top);
				if (y.bottom) y.bottom = Math.round(y.bottom);

				tar.css($.extend({}, x, y));
			}
		}

		function pinterestShare(event) {
			$("body").append('<script src="' + settings.shareServices.pinterest.file + '" type="text/javascript"></script>');
			event.preventDefault();
		}

		function sharePopup(event) {
			var url = event.data.url;
			var params = event.data.params;
			var winLeft;
			var winParams;

			if (params.left === "center") {
				winLeft = ($window.width() - params.width) / 2;
			} else {
				winLeft = params.left;
			}
			
			winParams = "menubar=no,toolbar=no,location=no,scrollbars=no,status=no,resizable=yes,width=" + params.width + ",height=" + params.height + ",top=" + params.top + ",left=" + winLeft;

			window.open(url, "sbShareWindow", winParams);

			event.preventDefault();
		}

		function showBar() {
			bar.removeClass("sb-hide");
			
			stopAnimate(bar);
			animate(bar, {"opacity": 1}, settings.barAnimate.show[0], settings.barAnimate.show[1]);

			barVisible = true;
		}
		function hideBar() {
			stopAnimate(bar);
			animate(bar, {"opacity": 0}, settings.barAnimate.show[0], settings.barAnimate.show[1], function() {
				bar.addClass("sb-hide");
			});

			barVisible = false;
		}

		function animate(target, props, duration, easing, complete) {
			if (settings.animateEngine === "velocity") {
				target.velocity(props, duration, easing, complete);
			} else {
				target.animate(props, duration, easing, complete);
			}
		}

		function stopAnimate(target) {
			if (settings.animateEngine === "velocity") {
				target.velocity("stop");
			} else {
				target.stop();
			}
		}
	});
}

function destroy() {
	return this.each(function() {
		var sidebar = $(this);
		var bar, sbwindow;

		if (sidebar.data("sb-built")) {
			sidebar.data("sb-built", false);

			bar = sidebar.children(".sb-bar");
			sbwindow = sidebar.children(".sb-window");

			bar.attr("class", "sb-bar").removeAttr("style");
			sbwindow.attr("class", "sb-window");

			destroyList(bar);

			sbwindow.removeClass("sb-show");
			sbwindow.children(".sb-shadow").off("click");
			sbwindow.children(".sb-panel").removeClass("sb-show").removeAttr("style").each(destroyPanel);

			$(window).off("resize.superSidebar scroll.superSidebar");

			sidebar.removeClass("sb-ready");
		}

		function destroyList(list) {
			list.children().each(function() {
				if ($(this).hasClass("sb-sub")) destroySub(this);
				else destroyButton(this);
			});
		}
		function destroyButton(btn) {
			var button = $(btn);
			var link = button.find("a");
			var label = link.children(".sb-label");

			if (link.data("share")) link.removeAttr("href target");

			link.children(".sb-hit").remove();

			if (button.children(".sb-mask").length) link.unwrap();

			label.removeAttr("style");

			link.off("mouseenter mouseleave click");
		}
		function destroySub(sub) {
			var sub = $(sub);
			var list = sub.children("ul");

			sub.removeClass("sb-side sb-circular sb-sub-space sb-posabs");

			list.removeClass("sb-hide");
			list.removeAttr("style");
			list.children().removeAttr("style");

			sub.children(".sb-subhit").remove();

			sub.off("mouseenter mouseleave");
		}
		function destroyPanel() {
			var panel = $(this);

			panel.find(".sb-close").off("click");

			var form = panel.find("form");
			if (form.length) destroyForm(form);
		}
		function destroyForm(form) {
			var fieldList = form.find("input, textarea");

			form.find(".sb-submit").off("click");
			form.off("submit");

			fieldList.removeClass("sb-formerror").off("focus");
			fieldList.each(function() {
				$(this).val("");
			});

			form.find(".sb-status").attr("class", "sb-status");
		}
	});
}

function createSettings(options) {
	var settings = $.extend({}, defaults, options);

	if (typeof settings.position === "string") {
		settings.position = settings.position.split("-");
	}
	if (settings.position[0] === "center") {
		settings.position[0] = defaults.position[0];
		warn('Bar horizontal position cannot be "center". Horizontal position reset to "left".');
	}
	if (!settings.position[1]) {
		settings.position[1] = defaults.position[1];
	}
	
	if (settings.offset === 0 || settings.offset === false) {
		settings.offset = [0, 0];
	} else if (typeof settings.offset === "string") {
		settings.offset = splitOffset(settings.offset);
	}

	if (!options.buttonShape && options.shape) {
		settings.buttonShape = settings.shape;
	}
	if (settings.buttonShape !== "square") {
		if (settings.buttonShape !== "round" && settings.buttonShape !== "rounded" && settings.buttonShape !== "rounded-out") {
			settings.buttonShape = "square";
		}
	}

	if (!options.buttonColor && options.color) {
		settings.buttonColor = settings.color;
	}
	if (settings.buttonColor === "default") {
		settings.buttonColor = "custom";
	}

	if (!options.buttonOverColor && options.overColor) {
		settings.buttonOverColor = settings.overColor;
	}
	if (settings.buttonOverColor === "default") {
		settings.buttonOverColor = "custom";
	}

	if (settings.labelColor === "match") {
		settings.labelColor = settings.buttonOverColor;
	}
	if (settings.labelTextColor === "match") {
		settings.labelTextColor = settings.iconOverColor;
	}

	if (settings.labelEffect === "slide") settings.labelEffect = "slide-out";
	if (settings.labelEffect === "slide-in-fade") settings.labelEffect = "slide-in";

	if (!options.labelAnimate && options.labelAnim) {
		settings.labelAnimate = settings.labelAnim;
	}
	if (settings.labelAnimate === "default") {
		if (labelAnimateDefaults[settings.labelEffect]) {
			settings.labelAnimate = labelAnimateDefaults[settings.labelEffect];
		} else {
			settings.labelAnimate = labelAnimateDefaults.default;
		}
	}
	settings.labelAnimate = extendAnimateSetting(settings.labelAnimate);

	if (settings.labelConnected) {
		if (settings.labelEffect === "slide-in" || settings.labelEffect === "slide-out-out" || settings.labelEffect === "slide-in-in") {
			settings.labelConnected = false;
			warn('"labelConnected: true" incompatible with "labelEffect: ' + settings.labelEffect + '". "labelConnected" reset to false.');
		} else if (settings.labelSpace) {
			settings.labelSpace = false;
			warn('"labelSpace: true" incompatible with "labelConnected: true". "labelSpace" reset to false.');
		}
	}


	if (typeof settings.subPosition === "string") {
		settings.subPosition = [settings.subPosition];
	}
	if (settings.subPosition[0] === "circular") {
		if (!settings.subPosition[1]) settings.subPosition[1] = defaults.subPosition[1];
		if (typeof settings.subPosition[2] === "undefined") settings.subPosition[2] = defaults.subPosition[2];
		if (typeof settings.subPosition[3] === "undefined") settings.subPosition[3] = defaults.subPosition[3];

		if (settings.subSpace) settings.subSpace = false;
	}

	if (!options.subAnimate && options.subAnim) {
		settings.subAnimate = settings.subAnim;
	}
	if (settings.subAnimate === "default") settings.subAnimate = defaults.subAnimate;

	if (typeof settings.subEffect === "string") {
		settings.subEffect = [settings.subEffect];
	}
	if ((settings.subEffect[0] === "linear-fade" || settings.subEffect[0] === "linear-slide") && !settings.subEffect[1]) {
		settings.subEffect[1] = defaults.subEffect[1];
	}

	settings.subAnimate = extendAnimateSetting(settings.subAnimate);


	if (typeof settings.windowPosition === "string") {
		settings.windowPosition = settings.windowPosition.split("-");
	}
	if (!settings.windowPosition[1]) {
		settings.windowPosition[1] = defaults.windowPosition[1];
	}

	if (settings.windowOffset === 0 || settings.windowOffset === false) {
		settings.windowOffset = [0, 0];
	} else if (typeof settings.windowOffset === "string") {
		settings.windowOffset = splitOffset(settings.windowOffset);
	}

	if (settings.windowCorners === "match") {
		if (settings.buttonShape === "round" || settings.buttonShape === "rounded" || settings.buttonShape === "rounded-out") {
			settings.windowCorners = "round";
		}
	}

	if (settings.windowColor === "match") {
		settings.windowColor = settings.buttonColor;
	} else if (settings.windowColor === "default") {
		settings.windowColor = "custom";
	}


	if (settings.barAnimate === "default") {
		settings.barAnimate = defaults.barAnimate;
	}

	settings.barAnimate = extendAnimateSetting(settings.barAnimate);

	if (settings.hideUnder) {
		settings.hideUnderWidth = settings.hideUnder;
	}

	
	settings.shareServices = $.extend(true, {}, shareServices, options.shareServices);


	if (settings.animateEngine === "jquery") {
		settings.animateEngine = "jQuery";
	}

	return settings;
}

function splitOffset(off) {
	off = off.split("-");
	off[0] = getInt(off[0]);
	if (off[1]) off[1] = getInt(off[1]);
	return off;
}

function extendAnimateSetting(animate) {
	if (Object.prototype.toString.call(animate) === "[object Array]") {
		return {
			show: animate,
			hide: animate
		};
	} else {
		return animate;
	}
}

function warn(msg) {
	if (window.console) {
		console.log("(!) Super Sidebar: " + msg);
	}
}

function getInt(val) {
	return parseInt(val, 10);
}

function validateEmail(email) {
	var exp = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return exp.test(email);
}

}(jQuery));

/**
 * jQuery UI easing
 * http://jqueryui.com
 */
 (jQuery.effects || (function($, undefined) {
 
 (function() {

// based on easing equations from Robert Penner (http://www.robertpenner.com/easing)

var baseEasings = {};

$.each( [ "Quad", "Cubic", "Quart", "Quint", "Expo" ], function( i, name ) {
	baseEasings[ name ] = function( p ) {
		return Math.pow( p, i + 2 );
	};
});

$.extend( baseEasings, {
	Sine: function ( p ) {
		return 1 - Math.cos( p * Math.PI / 2 );
	},
	Circ: function ( p ) {
		return 1 - Math.sqrt( 1 - p * p );
	},
	Elastic: function( p ) {
		return p === 0 || p === 1 ? p :
			-Math.pow( 2, 8 * (p - 1) ) * Math.sin( ( (p - 1) * 80 - 7.5 ) * Math.PI / 15 );
	},
	Back: function( p ) {
		return p * p * ( 3 * p - 2 );
	},
	Bounce: function ( p ) {
		var pow2,
			bounce = 4;

		while ( p < ( ( pow2 = Math.pow( 2, --bounce ) ) - 1 ) / 11 ) {}
		return 1 / Math.pow( 4, 3 - bounce ) - 7.5625 * Math.pow( ( pow2 * 3 - 2 ) / 22 - p, 2 );
	}
});

$.each( baseEasings, function( name, easeIn ) {
	$.easing[ "easeIn" + name ] = easeIn;
	$.easing[ "easeOut" + name ] = function( p ) {
		return 1 - easeIn( 1 - p );
	};
	$.easing[ "easeInOut" + name ] = function( p ) {
		return p < 0.5 ?
			easeIn( p * 2 ) / 2 :
			1 - easeIn( p * -2 + 2 ) / 2;
	};
});

})();

})(jQuery));
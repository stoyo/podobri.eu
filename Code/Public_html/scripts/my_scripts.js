$(document).ready(function () {

    $('#searchQuery').autocomplete({
        minLength: 2,
        autofocus: true,
        source: 'https://www.podobri.eu/getdata',
        select: function (event, ui) {
            window.location.href = ui.item.link;
        }
    });

    /* toggle hide show map */

    $('.click').click(function () {
        if ($('#map').hasClass('hidden')) {
            $('.click').text('скрийте картата');
            $('#map').removeClass('hidden');
            google.maps.event.trigger(map, 'resize');
        } else {
            $('.click').text('вижте на карта');
            $('#map').addClass('hidden');
        }
    });

    /* toggle add video add images */

    $('.swtichfieldv').click(function () {
        if ($('#videofield').hasClass('notvisible')) {
            $('#videofield').removeClass('notvisible');
            $('#picturefield').addClass('notvisible');
            $('#videomenu').addClass('active');
            $('#picturemenu').removeClass('active');
        } else {

        }
    });

    $('.swtichfieldp').click(function () {
        if ($('#picturefield').hasClass('notvisible')) {
            $('#videofield').addClass('notvisible');
            $('#picturefield').removeClass('notvisible');
            $('#videomenu').removeClass('active');
            $('#picturemenu').addClass('active');

        } else {

        }
    });

    /* click focus input field */

    $('.comment').click(function () {
        $('#prob-com-input').focus();
    });

    $('.problem-holder .show-prob-com').click(function () {
        if ($(this).parent().parent().parent().find($('.problem-holder #prob-com')).hasClass('hidden')) {
            $(this).parent().parent().parent().find($('.problem-holder #prob-com')).removeClass('hidden');
            $(this).parent().parent().parent().find($('.problem-holder .comment-input')).focus();
        } else {
            $(this).parent().parent().parent().find($('.problem-holder #prob-com')).addClass('hidden');
        }
    });

    /* Comment input field show on click */

    $('.problem-holder .comment-or-show').click(function () {
        if ($(this).parent().parent().parent().parent().find($('.problem-holder #prob-com')).hasClass('hidden')) {
            $(this).parent().parent().parent().parent().find($('.problem-holder #prob-com')).removeClass('hidden');
            $(this).parent().parent().parent().parent().find($('.problem-holder #reply')).focus();
        } else {
            $(this).parent().parent().parent().parent().find($('.problem-holder #reply')).focus();
        }
    });

    /* Reply input field show on click */

    $('.reply-form .clickreply').click(function () {
        if ($(this).parent().parent().find($('.reply-form #replyformwrapper')).hasClass('hidden')) {
            $(this).parent().parent().find($('.reply-form #replyformwrapper')).removeClass('hidden');
            $(this).parent().parent().find($('.reply-form textarea')).focus();
        } else {
            $(this).parent().parent().find($('.reply-form #replyformwrapper')).addClass('hidden');
        }
    });

    /* Toggle sort */

    $('.activatefilters').click(function () {
        if ($('.filterinout').hasClass('hidefirst')) {
            $('.filterinout').removeClass('hidefirst');
        } else {
            $('.filterinout').addClass('hidefirst');
        }
    });

});

/* Javascript form validation */

document.addEventListener("DOMContentLoaded", function () {
    var elements = document.getElementsByTagName("INPUT");
    for (var i = 0; i < elements.length; i++) {
        elements[i].oninvalid = function (e) {
            e.target.setCustomValidity("");
            if (!e.target.validity.valid) {
                e.target.setCustomValidity("Пропуснахте поле");
            }
        };
        elements[i].oninput = function (e) {
            e.target.setCustomValidity("");
        };
    }

    var elements = document.getElementsByTagName("TEXTAREA");
    for (var i = 0; i < elements.length; i++) {
        elements[i].oninvalid = function (e) {
            e.target.setCustomValidity("");
            if (!e.target.validity.valid) {
                e.target.setCustomValidity("Пропуснахте поле");
            }
        };
        elements[i].oninput = function (e) {
            e.target.setCustomValidity("");
        };
    }

    var elements = document.getElementsByTagName("SELECT");
    for (var i = 0; i < elements.length; i++) {
        elements[i].oninvalid = function (e) {
            e.target.setCustomValidity("");
            if (!e.target.validity.valid) {
                e.target.setCustomValidity("Пропуснахте поле");
            }
        };
        elements[i].oninput = function (e) {
            e.target.setCustomValidity("");
        };
    }
});

if ($(window).width() > 900) {
    $('#google-link, #twitterbtn-link, #facebookbtn-link').click(function (event) {
        var width = 750,
                height = 500,
                left = ($(window).width() - width) / 2,
                top = ($(window).height() - height) / 2,
                url = this.href,
                opts = 'status=1' +
                ',width=' + width +
                ',height=' + height +
                ',top=' + top +
                ',left=' + left;

        window.open(url, 'twitter', opts);
        return false;
    });
} else {
    $('#google-link, #twitterbtn-link, #facebookbtn-link').click(function (event) {
        var width = 320,
                height = 400,
                left = ($(window).width() - width) / 2,
                top = ($(window).height() - height) / 2,
                url = this.href,
                opts = 'status=1' +
                ',width=' + width +
                ',height=' + height +
                ',top=' + top +
                ',left=' + left;

        window.open(url, 'twitter', opts);
        return false;
    });
}

/* Are you sure you want to leave this page functionality */

    if (!window.matchMedia('(max-width: 992px)').matches) {
        $(function () {
    		$("form").not('.navbar-form-alt').not('.commnent-form').areYouSure(
            		{
                		message: ''
            		}
    		);
	});
    }

/* show number of files */

$(document).on('change', '.btn-file :file', function () {
    var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
});

$(document).ready(function () {
    $('.btn-file :file').on('fileselect', function (event, numFiles, label) {

        var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' избрани файла' : label;

        if (input.length) {
            input.val(log);
        } else {
            if (log)
                alert(log);
        }

    });
});

/* Image thumbnail preview functionality */
window.onload = function () {
    // api support
    if (window.File && window.FileList && window.FileReader) {
        $('#video').on("change", function (event) {
            var files = event.target.files; //FileList object
            var file = files[0];
            if (file.type.match('video.*')) {
                if (this.files[0].size > 230686720) {
                    alert("Максималната разрешена големина на видео е 220MB.");
                    $(this).val("");
                }
            } else {
                alert("В това поле можете да добавяте само видеа.");
                $(this).val("");
            }
        });
        $('#files').on("change", function (event) {
            var files = event.target.files; //FileList обект
            var output = document.getElementById("result");
            if (files.length <= 9) {
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    //Само картинки
                    // if(!file.type.match('image'))
                    if (file.type.match('image.*')) {
                        if (this.files[0].size < 3500000) {
                            // continue
                            var picReader = new FileReader();
                            picReader.addEventListener("load", function (event) {
                                var picFile = event.target;
                                var div = document.createElement("div");
                                div.innerHTML = "<img class='thumbnail' src='" + picFile.result + "'" +
                                        "title='Предварителен преглед на снимка'/>";
                                output.insertBefore(div, null);
                            });
                            // Read image
                            $('#clear, #result').show();
                            picReader.readAsDataURL(file);
                        } else {
                            alert("Максималната разрешена големина на снимка е 3.5MB.");
                            $(this).val("");
                        }
                    } else {
                        alert("В това поле можете да добавяте само снимки.");
                        $(this).val("");
                    }
                }
            } else {
                $(this).val("");
                $('#alert').show();
            }

        });
    } else {
        console.log("Съжаляваме, браузърът ви не поддържа File API. Нямаме възможност да покажем предварителен преглед на картинките.");
    }
};

$('#files').on("click", function () {
    $('.thumbnail').parent().remove();
    $('#result').hide();
    $('#clear').hide();
    $('#alert').hide();
    $('#representer').val("");
    $(this).val("");
});

$('#clear').on("click", function () {
    $('.thumbnail').parent().remove();
    $('#result').hide();
    $('#alert').hide();
    $('#representer').val("");
    $(this).hide();
});

/* First time popup cookie */

//<![CDATA[
jQuery.cookie = function (key, value, options) {

    if (arguments.length > 1 && String(value) !== "[object Object]") {
        options = jQuery.extend({}, options);

        if (value === null || value === undefined) {
            options.expires = -1;
        }

        if (typeof options.expires === 'number') {
            var days = options.expires, t = options.expires = new Date();
            t.setDate(t.getDate() + days);
        }

        value = String(value);

        return (document.cookie = [
            encodeURIComponent(key), '=',
            options.raw ? value : encodeURIComponent(value),
            options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
            options.path ? '; path=' + options.path : '',
            options.domain ? '; domain=' + options.domain : '',
            options.secure ? '; secure' : ''
        ].join(''));
    }

    options = value || {};
    var result, decode = options.raw ? function (s) {
        return s;
    } : decodeURIComponent;
    return (result = new RegExp('(?:^|; )' + encodeURIComponent(key) + '=([^;]*)').exec(document.cookie)) ? decode(result[1]) : null;
};
//]]>

jQuery(document).ready(function ($) {
    if ($.cookie('popup_user_login') != 'yes') {
        $('#fanback').delay(8000).queue(function () {
            $(this).fadeIn('medium');
            $(this).dequeue();
        });
        $('#Burp, #fan-exit').click(function () {
            $('#fanback').stop().fadeOut('medium');
        });
    }
    $.cookie('popup_user_login', 'yes', {path: '/', expires: 7});
});

autosize($('textarea'));

/* Form submission on enter */

$('#prob-com-input, #reply').keydown(function (event) {
    if (event.keyCode == 13) {
        $(this.form).submit()
        return false;
    }
});

/* toggle read more/ less */

$('.more').readmore({
    collapsedHeight: 40,
    lessLink: '<a class="margin-top--7" href="#">Скрийте</a>',
    moreLink: '<a href="#">Прочетете още</a>'
});

/* Transliterator */

function transliterate(obj, word) {
    var answer = ""
            , a = {}
    , b = {}
    , condition = "off";

    a["a"] = "a";
    a["b"] = "б";
    a["w"] = "в";
    a["g"] = "г";
    a["d"] = "д";
    a["e"] = "е";
    a["v"] = "ж";
    a["z"] = "з";
    a["i"] = "и";
    a["j"] = "й";
    a["k"] = "к";
    a["l"] = "л";
    a["m"] = "м";
    a["n"] = "н";
    a["o"] = "о";
    a["p"] = "п";
    a["r"] = "р";
    a["s"] = "с";
    a["t"] = "т";
    a["u"] = "у";
    a["f"] = "ф";
    a["h"] = "х";
    a["c"] = "ц";
    a["`"] = "ч";
    a["["] = "ш";
    a["]"] = "щ";
    a["y"] = "ъ";
    a["x"] = "ь";
    a["\\"] = "ю";
    a["q"] = "я";
    a["A"] = "А";
    a["B"] = "Б";
    a["W"] = "В";
    a["G"] = "Г";
    a["D"] = "Д";
    a["E"] = "Е";
    a["V"] = "Ж";
    a["Z"] = "З";
    a["I"] = "И";
    a["J"] = "Й";
    a["K"] = "К";
    a["L"] = "Л";
    a["M"] = "М";
    a["N"] = "Н";
    a["O"] = "О";
    a["P"] = "П";
    a["R"] = "Р";
    a["S"] = "С";
    a["T"] = "Т";
    a["U"] = "У";
    a["F"] = "Ф";
    a["H"] = "Х";
    a["C"] = "Ц";
    a["~"] = "Ч";
    a["{"] = "Ш";
    a["}"] = "Щ";
    a["Y"] = "Ъ";
    a["X"] = "Ь";
    a["|"] = "Ю";
    a["Q"] = "Я";

    b["d"] = "а";
    b["/"] = "б";
    b["l"] = "в";
    b["h"] = "г";
    b["o"] = "д";
    b["e"] = "е";
    b["g"] = "ж";
    b["p"] = "з";
    b["r"] = "и";
    b["x"] = "й";
    b["u"] = "к";
    b["."] = "л";
    b[";"] = "м";
    b["k"] = "н";
    b["f"] = "о";
    b["m"] = "п";
    b[","] = "р";
    b["i"] = "с";
    b["j"] = "т";
    b["w"] = "у";
    b["b"] = "ф";
    b["n"] = "х";
    b["["] = "ц";
    b["'"] = "ч";
    b["t"] = "ш";
    b["y"] = "щ";
    b["c"] = "ъ";
    b["a"] = "ь";
    b["z"] = "ю";
    b["s"] = "я";
    b["q"] = "";
    b["v"] = "";
    b["D"] = "А";
    b["?"] = "Б";
    b["L"] = "В";
    b["H"] = "Г";
    b["O"] = "Д";
    b["E"] = "Е";
    b["G"] = "Ж";
    b["P"] = "З";
    b["R"] = "И";
    b["X"] = "Й";
    b["U"] = "К";
    b[">"] = "Л";
    b[":"] = "М";
    b["K"] = "Н";
    b["F"] = "О";
    b["M"] = "П";
    b["<"] = "Р";
    b["I"] = "С";
    b["J"] = "Т";
    b["W"] = "У";
    b["B"] = "Ф";
    b["N"] = "Х";
    b["{"] = "Ц";
    b['"'] = "Ч";
    b["T"] = "Ш";
    b["Y"] = "Щ";
    b["C"] = "Ъ";
    b["A"] = "Ь";
    b["Z"] = "Ю";
    b["S"] = "Я";
    b["Q"] = "";
    b["V"] = "";

    var children = $(obj).next().children();

    if ($(children).first().hasClass("current")) {
        var condition = 'pho';
    }

    if ($(children).eq(1).hasClass("current")) {
        var condition = 'bds';
    }

    switch (condition) {
        case 'pho':
            for (i in word) {
                if (word.hasOwnProperty(i)) {
                    if (a[word[i]] === undefined) {
                        answer += word[i];
                    } else {
                        answer += a[word[i]];
                    }
                }
            }

            obj.value = answer;
            break;
        case 'bds':
            for (i in word) {
                if (word.hasOwnProperty(i)) {
                    if (b[word[i]] === undefined) {
                        answer += word[i];
                    } else {
                        answer += b[word[i]];
                    }
                }
            }

            obj.value = answer;
            break;
        default:
            obj.value = word;
            break;

    }

}

$(".transliterate").on("input propertychange", function () {
    transliterate(this, $(this).val());
});

$('.pho').click(function () {
    if ($(this).hasClass('current')) {
        $(this).removeClass('current').hide();
        if ($(this).next('.pho').length > 0) {
            $(this).next('.pho').addClass('current').show();
        } else {
            $(this).siblings('.pho').first().addClass('current').show();
        }
    }
});

/* hightlight text matching search query */

$(".hsfield").highlight($('.highlight').text());

/* loading gif on form submit */

function validation() {
    $("button[type=submit][clicked=true]").css('display', 'none');
    $("#wait_tip").css('display', '');

    if (navigator.userAgent.indexOf("MSIE") > 0) {
        setTimeout(function () {
            $("#loading_img").src = $("#loading_img").src
        },
                10);
    } else {
        $("#loading_img").src = "./images/loading-gif.gif";
    }

    return true;
}
$('form').not('.navbar-form-alt').not('.commnent-form').on('submit', function () {
    return validation(this);
});

$("form button[type=submit]").click(function() {
    $("button[type=submit]", $(this).parents("form")).removeAttr("clicked");
    $(this).attr("clicked", "true");
}); 
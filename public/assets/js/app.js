/**
 * Created by simon on 17/07/2017.
 */

var resizeIFrame = function () {
    var contentWapper = $('.parent-window-content-wapper');
    var height = contentWapper.height();
    contentWapper.children('.content').children('iframe').css('height', height - 5);
    $(window).resize(function () {
        height = contentWapper.height();
        contentWapper.children('.content').children('iframe').css('height', height - 5);
    });
};

var sidebarClick = function () {
    $('.sidebar-menu-item').on('click', function () {
        $(this).siblings('li').each(function (index, element) {
            $(element).removeClass('active');
            if ($(element).hasClass('treeview')) {
                $(element).children('.treeview-menu').css('display', 'none');
            }
        });
        if (!$(this).hasClass('active')) {
            $(this).addClass('active')
        }
    });

    $('.treeview-menu > li').on('click', function () {
        $(this).siblings('li').each(function (index, element) {
            $(element).removeClass('active');
        });
        if (!$(this).hasClass('active')) {
            $(this).addClass('active')
        }
    });
};

var roleActionsCheckboxRelate = function () {
    $('.parentRoleAction').on('click', function () {
        if ($(this).is(':checked')) {
            // 勾选，将所有子菜单勾选
            $(this).parents('table').find('.childRoleAction').each(function (index, element) {
                $(element).prop('checked', true);
            });
        } else {
            // 移除勾选，移除所有子菜单的勾选状态
            $(this).parents('table').find('.childRoleAction').each(function (index, element) {
                $(element).prop('checked', false);
            });
        }
    });

    $('.childRoleAction').on('click', function () {
        if ($(this).is(':checked')) {
            // 子菜单勾选，则触发父级菜单勾选
            $(this).parents('table').find('.parentRoleAction').prop('checked', true);
        } else {
            // 子菜单移除勾选，判断当前子菜单勾选数量，如果为0，则移除父级菜单的勾选
            var table = $(this).parents('table');
            if (table.find('.childRoleAction:checked').length === 0) {
                table.find('.parentRoleAction').prop('checked', false);
            }
        }
    });
};

var chunk = function (array, size) {
    var temp = [];
    for (var i = 0; i< array.length; i = i + size) {
        var tempArr = array;
        temp.push(tempArr.slice(i, i + size))
    }
    return temp;
};

var setActionIcons = function () {
    var icons = [];
    var maxIconsCountInLine = 0;
    var maxIconsDisplayLines = 6;
    var currentPage = 0;
    var lastPage = 0;
    var modalWidth = 0;
    if (typeof actionIcons !== 'undefined') {
        icons = JSON.parse(actionIcons);
        $('#setActionIconModal').on('shown.bs.modal', function () {
            $('.set-actions-icon-name').val('');
            modalWidth = $('.set-actions-icons-list-modal').width();
            maxIconsCountInLine = Math.floor(modalWidth / 38);
            pageIconsCount = maxIconsDisplayLines * (maxIconsCountInLine === 0 ? 8 : maxIconsCountInLine);
            actionIcons = chunk(icons, pageIconsCount);
            lastPage = actionIcons.length;
            appendActionIconsListHtml(actionIcons[currentPage], maxIconsCountInLine, maxIconsDisplayLines, currentPage, lastPage);
        });

        $('.set-actions-previous').on('click', function () {
            if (!$(this).hasClass('disabled')) {
                var previousPage = $(this).data('previous');
                appendActionIconsListHtml(actionIcons[previousPage], maxIconsCountInLine, maxIconsDisplayLines, previousPage, lastPage);
            }
        });

        $('.set-actions-next').on('click', function () {
            if (!$(this).hasClass('disabled')) {
                var nextPage = $(this).data('next');
                appendActionIconsListHtml(actionIcons[nextPage], maxIconsCountInLine, maxIconsDisplayLines, nextPage, lastPage);
            }
        });

        $('.set-actions-icon-name').on('input propertychange', function () {
            var words = $(this).val();
            var resultIcons = searchIconsArray(words, icons);
            if (resultIcons.length > 0) {
                actionIcons = chunk(resultIcons, pageIconsCount);
                lastPage = actionIcons.length;
                appendActionIconsListHtml(actionIcons[currentPage], maxIconsCountInLine, maxIconsDisplayLines, currentPage, lastPage);
            } else {
                appendActionIconsListHtml([], maxIconsCountInLine, maxIconsDisplayLines, -1, 0);
            }
        });
    }
};

var appendActionIconsListHtml = function (icons, iconsCountInLine, maxIconsDisplayLines, currentPage, lastPage) {
    var html = '<tr>';
    var maxDisplayIcons = maxIconsDisplayLines * iconsCountInLine;
    var maxIconsCountInLine = iconsCountInLine === 0 ? 8 : iconsCountInLine;
    var displayCount = icons.length > maxDisplayIcons ? maxDisplayIcons : icons.length;
    var lastIconIndex = displayCount - 1;
    var selectedIcon = $('.set-action-icon-value').val();
    for (var i = 0; i < displayCount; i++) {
        if (selectedIcon === icons[i]) {
            html += '<td><button class="btn btn-warning set-actions-icon-button" data-icon="' + icons[i] + '" onclick="selectActionIcon($(this));">';
        } else {
            html += '<td><button class="btn btn-default set-actions-icon-button" data-icon="' + icons[i] + '" onclick="selectActionIcon($(this));">';
        }
        html += '<i class="fa ' + icons[i] + '" aria-hidden="true"></i></button></td>';
        if (((i+1) % maxIconsCountInLine === 0) || i === lastIconIndex) {
            html += '</tr>';
            if (i !== lastIconIndex) {
                html += '<tr>';
            }
        }
    }
    var addOn = maxIconsCountInLine - (i % maxIconsCountInLine);
    if (addOn !== 0 && (addOn !== maxIconsCountInLine || i === 0)) {
        if (i !== 0) {
            html = html.substring(0, html.length - 5);
        }
        for (var j = 0; j < addOn; j++) {
            html += '<td></td>';
        }
        html += '</tr>';
    }
    $('.set-actions-icons-list > tbody').html(html);
    var paginate = $('.set-actions-page-info');
    paginate.attr('colspan', maxIconsCountInLine - 2);
    $('.set-actions-icon-label').parent('td').attr('colspan', maxIconsCountInLine);
    var previousBtn = $('.set-actions-previous');
    var nextBtn = $('.set-actions-next');
    if (currentPage <= 0) {
        if (!previousBtn.hasClass('disabled')) {
            previousBtn.addClass('disabled')
        }
    } else {
        if (previousBtn.hasClass('disabled')) {
            previousBtn.removeClass('disabled')
        }
    }
    if (currentPage >= (lastPage - 1)) {
        if (!nextBtn.hasClass('disabled')) {
            nextBtn.addClass('disabled')
        }
    } else {
        if (nextBtn.hasClass('disabled')) {
            nextBtn.removeClass('disabled')
        }
    }
    paginate.html((currentPage + 1) + ' / ' + lastPage);
    previousBtn.data('previous', currentPage - 1);
    nextBtn.data('next', currentPage + 1);
};

var selectActionIcon = function (e) {
    $('.set-action-icon').html('<i class="fa ' + e.data('icon') + '" aria-hidden="true"></i>');
    $('.set-action-icon-value').val(e.data('icon'));
    if (!e.hasClass('btn-warning')) {
        e.removeClass('btn-default');
        e.parents('tbody').find('.btn').each(function (index, element) {
            if ($(element).hasClass('btn-warning')) {
                $(element).removeClass('btn-warning');
                $(element).addClass('btn-default');
            }
        });
        e.addClass('btn-warning');
    }
};



var uploadFiles = function () {

    $('.btn-file').on('click', function () {
        if ($(this).hasClass('disabled')) {
            return false;
        } else {
            $(this).addClass('disabled');
            setTimeout(function () {
                $('.btn-file').removeClass('disabled');
            }, 1200);
        }
    });
};

var searchIconsArray =  function(str, container) {
    var nPos;
    var vResult = [];

    for(var i in container){
        var sTxt=container[i]||'';
        nPos=sTxt.indexOf(str);
        if(nPos>=0){
            vResult[vResult.length] = sTxt;
        }
    }
    return vResult;
};

$(document).ready(function () {
    uploadFiles();
    resizeIFrame();
    sidebarClick();
    setActionIcons();
    roleActionsCheckboxRelate();
});
/*
 * This is the plugin
 */
(function (a) {
    $(".view-pdf").magnificPopup({ type: "image" });
    a.createModal = function (b) {
        defaults = {
            title: "",
            message: "Your Message Goes Here!",
            closeButton: true,
            scrollable: false,
        };
        var b = a.extend({}, defaults, b);
        var c =
            b.scrollable === true
                ? 'style="max-height: 420px;overflow-y: auto;"'
                : "";
        html = '<div class="modal fade" id="myModal">';
        html += '<div class="modal-dialog">';
        html += '<div class="modal-content">';
        html += '<div class="modal-header">';
        html +=
            '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
        if (b.title.length > 0) {
            html += '<h4 class="modal-title">' + b.title + "</h4>";
        }
        html += "</div>";
        html += '<div class="modal-body" ' + c + ">";
        html += b.message;
        html += "</div>";
        html += '<div class="modal-footer">';
        if (b.closeButton === true) {
            html +=
                '<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>';
        }
        html += "</div>";
        html += "</div>";
        html += "</div>";
        html += "</div>";
        a("body").prepend(html);
        a("#myModal")
            .modal()
            .on("hidden.bs.modal", function () {
                a(this).remove();
            });
    };
})(jQuery);

/*
 * Here is how you use it
 */
$(function () {
    // $(".view-pdf").on("click", function () {
    //     var pdf_link = $(this).attr("href");
    //     var iframe =
    //         '<div class="iframe-container"><iframe src="' +
    //         pdf_link +
    //         '"></iframe></div>';
    //     // $.createModal({
    //     //     title: "My Title",
    //     //     message: iframe,
    //     //     closeButton: true,
    //     //     scrollable: false,
    //     // });
    //     document.body.appendChild(iframe);
    //     alert(pdf_link);
    //     return false;
    // });
    $("#dialog").dialog({
        modal: true,
        title: fileName,
        width: 540,
        height: 450,
        buttons: {
            Close: function () {
                $(this).dialog("close");
            },
        },
        open: function () {
            var object =
                '<object data="{FileName}" type="application/pdf" width="500px" height="300px">';
            object +=
                'If you are unable to view file, you can download from <a href = "{FileName}">here</a>';
            object +=
                ' or download <a target = "_blank" href = "http://get.adobe.com/reader/">Adobe PDF Reader</a> to view the file.';
            object += "</object>";
            object = object.replace(/{FileName}/g, "Files/" + fileName);
            $("#dialog").html(object);
        },
    });
});

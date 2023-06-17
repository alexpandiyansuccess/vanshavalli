import React, {useEffect} from "react";
import Table from "react-bootstrap/Table";
import ReactDOM from "react-dom";
import Cropper from "cropperjs";
import $ from "jquery";
("use strict");
var zoomout = 1;
let flag = 0;
let checkbox_flag = 0;
let deleteItemId = [];
function Manage() {
    useEffect(() => {
        let image = document.getElementById("profile_image");
        let cropper = new Cropper(image, {
            aspectRatio: 16 / 9,
            dragMode: "move",
            viewMode: 4,
            aspectRatio: 1
        });

        let second_image = document.getElementById("profile_image_1");
        let second_cropper = new Cropper(second_image, {
            aspectRatio: 16 / 9,
            dragMode: "move",
            viewMode: 3,
            aspectRatio: 1
        });
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });
        $(".edit_icon").on("click", function (event) {
            AddCheckClass(this);
        })
        $(".edit_icon_table").on("click", function (event) {
            AddCheckClass(this);
        })
        function AddCheckClass(el) {
            checkbox_flag = 0;
            let id = el.attributes[1].value
            let selectedItem = $(".edit_icon[data-id=" + id + "]");
            let selectedItemTable = $(".edit_icon_table[data-id=" + id + "]");
            selectedItem.toggleClass('fa fa-check');
            selectedItemTable.toggleClass('fa fa-check');
            if (selectedItem.hasClass('fa fa-check')) {
                deleteItemId.push(id);
            } else {
                deleteItemId = deleteItemId.filter(item => item != id)
            } check_to_show_multidelete_button();

            if (deleteItemId.length == $(".edit_icon").length) {
                $(".select_all-btn").text("Unselect all")
                checkbox_flag = 1;
            } else {
                $(".select_all-btn").text("Select all")
            }
        }

        $(".multi_delete_button button").on("click", function () {
            if (deleteItemId.length == 0) {
                return;
            }
            if (confirm("Are you Sure you want to delete selected items")) {
                $.ajax({
                    url: APP_URL + "/org/multi-delete",
                    type: "POST",
                    data: {
                        node_ids: deleteItemId
                    }
                }).then((res) => {
                    deleteItemId.forEach(el => {
                        $(".tree-col[data-id=" + el + "]").remove();
                        $(".mytable-row[data-id=" + el + "]").remove();
                        $(".multi_delete_button").css('display', 'none');
                    })
                }).catch((err) => {});
            }
        })

        $(".select_all-btn").on("click", function () {
            deleteItemId = []
            let checkbox = $(".edit_icon");
            let checkbox_table = $(".edit_icon_table");
            if (checkbox_flag == 0) {
                checkbox_table.addClass('fa fa-check')
                checkbox.addClass('fa fa-check')
                $(".select_all-btn").text("Unselect all")
                checkbox_flag = 1;
            } else {
                checkbox_table.removeClass('fa fa-check');
                checkbox.removeClass('fa fa-check')
                $(".select_all-btn").text("Select all")
                checkbox_flag = 0;
            } checkbox.each(el => {
                let id = checkbox[el].attributes[1].value;
                if (checkbox.hasClass('fa fa-check')) {
                    deleteItemId.push(id);
                } else {
                    deleteItemId = [];
                }
            })
            check_to_show_multidelete_button();
        })


        function check_to_show_multidelete_button() {
            if (deleteItemId.length > 0) {
                $(".multi_delete_button").css('display', 'block');
            } else {
                $(".multi_delete_button").css('display', 'none');
            }
        }

        if (localStorage.getItem("tree_view") == 'table') {
            $(".mycol").hide();
            $(".mytable").show();
            flag = 1
        } else {
            $(".mycol").show();
            $(".mytable").hide();
            flag = 0
        }

        $(".switcher").on("click", function (event) {
            $(".switcher").addClass("spin")
            if (flag == 0) {
                $(".mycol").hide();
                $(".mytable").show();
                localStorage.setItem("tree_view", 'table')
                flag = 1
            } else {
                $(".mycol").show();
                $(".mytable").hide();
                localStorage.removeItem("tree_view")
                flag = 0;
            }
            setTimeout(() => {
                $(".switcher").removeClass("spin")
            }, 500);
        })
        $(".manage").on("click", function (event) {
            const id = $(this).attr("data-id");
            manageTree(id);
        });
        $("#inputImage").on("change", function (event) {

            const file = event.target.files[0];
            let url = URL.createObjectURL(file);
            var urlCreator = window.URL || window.webkitURL;
            var imageUrl = urlCreator.createObjectURL(file);
            cropper.replace(imageUrl);
        });

        $("#inputImage_second_profile").on('change', function (event) {

            const file = event.target.files[0];
            var urlCreator = window.URL || window.webkitURL;
            var imageUrl = urlCreator.createObjectURL(file);
            second_cropper.replace(imageUrl);
        })

        $("#back").on("click", function () {
            $("#panel2").slideUp("slow", function () {
                $("#panel1").slideDown("slow", function () {});
            });
        });
        var zoomin = 1;
        $("#zoom").on("click", function () {

            $(".tree").css("transform", `scale(${
                zoomin += 0.2
            })`);

        });

        $("#addparent").on("click", function (event) {
            event.preventDefault();
            let nodeid = $("#nodeid").val();
            let testStr = $("#" + nodeid).hasClass("root node");
            if (testStr) {
                let child_id = nodeid;
                let node_name = "Node";

                $.ajax({
                    url: APP_URL + "/org/addparent",
                    type: "POST",
                    data: {
                        node_name,
                        child_id,
                        designation: $("#designation").val(),
                        color: $("#color").val()
                    }
                }).then((res) => {

                    var name = node_name;
                    $(".root").removeClass("root");
                    var designation = $("#designation").val();
                    var anc = $("<a class='root node' id='" + jQuery.parseJSON(res).code + "'> <img class='tree-image' src='" + APP_URL + "/images/def.jpeg' width='70'> <br><div class='position'>" + designation + "</div> <span class='nodetext'>" + name + "</span></a>");

                    var li = $("<li/>");
                    li.append(anc);
                    var ul = $("<ul/>");
                    ul.append(li);
                    li.append($(".tree").html());
                    $(".tree").html(ul);
                    let color = $("#color").val()
                    let color_class = window.colorConfig[color];
                    $("#" + jQuery.parseJSON(res).code + " .nodetext").attr("class", `nodetext ${color_class}-background`);
                    $("#" + jQuery.parseJSON(res).code + " .tree-image").attr("class", `child-image ${color_class}-border`);

                    $("#nodeModal").modal("hide");
                }).catch((err) => {});
            } else {}
        });

        $("#deletenode, #deletenode_second_profile").on("click", function (event) {

            event.preventDefault();

            let nodeid = $("#nodeid").val();

            let node_id = nodeid;

            $.ajax({
                url: APP_URL + "/org/delete",
                type: "POST",
                data: {
                    node_id
                }
            }).then((res) => {
                $("#" + nodeid).parent().remove();
                $("#nodeModal").modal("hide");
            }).catch((err) => {});
        });

        $("#savenodename,#savenodename_second_profile").on("click", function () {
            $("#nodeModal").modal("hide");
            $.ajax({
                url: APP_URL + "/manage-chart/update/" + $("#nodeid").val(),
                type: "PATCH",
                data: {
                    profile_name: $("#nodename").val(),
                    designation: $("#designation").val(),
                    color: $("#color").val(),
                    designation2: $('#designation2').val()
                }
            }).then((res) => {
                let node_id = $("#nodeid").val();
                let color = $("#color").val();
                $("#" + node_id + " .nodetext").text($("#nodename").val());
                $("#" + node_id + " .position").text($("#designation").val());
                if ($('#designation2').val() != "") {
                    $("#" + node_id + " .child_images").append(`<img class="tree-img ${
                        $("#color").val()
                    }-border"  id="image_2" style="left: 85px "  src="${APP_URL}/images/def.jpeg" width="70" ></img>`);
                    $("#" + node_id + " #image_1").css('left', '18px');
                    $("#" + node_id).attr('title', $('#designation2').val());
                }
                $("#" + node_id + " .designation_second").val($('#designation2').val());
                let color_class = window.colorConfig[color];
                $("#" + node_id + " .nodetext").attr("class", `nodetext ${color_class}-background !important`);
                $("#" + node_id + " img").attr("class", `child-image ${color_class}-border !important`);
            }).catch((err) => {});
        });
        $("#save_image, #save_image_second_profile").on("click", function () {
            $(".uploads_button").css('display', 'none');
            $(".upload_loading").css('display', 'flex');
            let button_id = $(this).attr('data-id');
            let files = $("#inputImage")[0].files;
            let second_profile_files = $("#inputImage_second_profile")[0].files;
            let formData = new FormData();
            if (files['length'] != 0) {
                formData.append('profile_image', dataURItoBlob(cropper.getCroppedCanvas().toDataURL()), 'profile_image_1.' + files[0].name.split('.').pop());
            }
            if (second_profile_files['length'] != 0) {
                formData.append('second_profile_image', dataURItoBlob(second_cropper.getCroppedCanvas().toDataURL()), 'profile_image_2.' + second_profile_files[0].name.split('.').pop());
            }
            formData.append('button_id', button_id);
            formData.append('_method', 'PATCH')
            $.ajax({
                url: APP_URL + "/manage-chart/update-image/" + $("#nodeid").val(),
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                cache: false
            }).then((res) => {
                $(".uploads_button").css('display', 'block');
                $(".upload_loading").css('display', 'none');
                if (button_id == 1) {
                    $("#" + $("#nodeid").val() + " #image_1").attr("src", cropper.getCroppedCanvas().toDataURL());
                } else {
                    $("#" + $("#nodeid").val() + " #image_2").attr("src", second_cropper.getCroppedCanvas().toDataURL());
                }
                $("#inputImage_second_profile").val('');
                $("#nodeModal").modal("hide");
            }).catch((err) => {
                $(".uploads_button").css('display', 'block');
                $(".upload_loading").css('display', 'none');
            });

        });


        function dataURItoBlob(dataURI) {
            // convert base64 to raw binary data held in a string
            // doesn't handle URLEncoded DataURIs - see SO answer #6850276 for code that does this
            var byteString = atob(dataURI.split(',')[1]);

            // separate out the mime component
            var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];

            // write the bytes of the string to an ArrayBuffer
            var ab = new ArrayBuffer(byteString.length);
            var ia = new Uint8Array(ab);
            for (var i = 0; i < byteString.length; i++) {
                ia[i] = byteString.charCodeAt(i);
            }
            return new Blob([ab], {type: mimeString});
        }

        $(".deletetree").on("click", function (e) {
            e.preventDefault();
            const id = $(this).attr("data-id");
            if (confirm("Are you Sure you want to delete")) {
                $.ajax({
                    url: APP_URL + "/org/delete",
                    type: "POST",
                    data: {
                        node_id: id
                    }
                }).then((res) => {
                    $(".tree-col[data-id=" + id + "]").remove();
                    $(".mytable-row[data-id=" + id + "]").remove();
                }).catch((err) => {});
            }
        });

        $("#addchild, #addchild_second_profile").on("click", function () {
            let nodeid = $("#nodeid").val();
            let designation = $("#designation").val();
            let color = $("#color").val();

            let node_name = "Child";
            let root_id = $(".root").attr("id");
            let parent_id = nodeid;

            
            $.ajax({
                url: APP_URL + "/org/create",
                type: "POST",
                data: {
                    color,
                    designation,
                    node_name,
                    root_id,
                    parent_id
                },
            }).then((res) => {
                if ($("#" + nodeid).parent().find("ul").length == 0) {
                    $("#" + nodeid).parent().append("<ul/>");
                    $("#" + nodeid).parent().find("ul").append("<li />");
                    var name = node_name;
                    let designation = $("#designation").val();

                    $("#" + nodeid).parent().find("ul").find("li:last").append("<a data-toggle='tooltip' data-placement='top' title='No Second Profile' class='node' id='" + res[Object.keys(res)[0]][0] + "'>  <input type='hidden' name='designation_second' id='designation_second' class='designation_second' value=''> <div class = 'child_images'><img class='child-image' id='image_1' src='" + APP_URL + "/images/def.jpeg' width='70'> </div> <br><div class='position'>" + designation + "</div><span class='nodetext'>" + name + "</span></a>");
                    let color = $("#color").val();
                    let color_class = window.colorConfig[color];
                    $("#" + res[Object.keys(res)[0]][0] + " .nodetext").attr("class", `nodetext ${color_class}-background`);
                    $("#" + res[Object.keys(res)[0]][0] + " .child-image").attr("class", `child-image ${color_class}-border`);
                    $("#nodeModal").modal("hide");
                } else {

                    let nodeid = $("#nodeid").val();
                    $("#" + nodeid).next("ul").append("<li><a data-toggle='tooltip' data-placement='top' title='No Second Profile' class='node' id='" + res[Object.keys(res)[0]][0] + "'> <input type='hidden' name='designation_second' id='designation_second' class='designation_second' value=''> <div class = 'child_images'><img id = 'image_1' class='child-image' src='" + APP_URL + "/images/def.jpeg' width='70'></div> <br> <div class='position'>" + designation + "</div> <span class='nodetext'>" + node_name + "</span></a></li>");
                    let color = $("#color").val();
                    let color_class = window.colorConfig[color];
                    $("#" + res[Object.keys(res)[0]][0] + " .nodetext").attr("class", `nodetext ${color_class}-background`);
                    $("#" + res[Object.keys(res)[0]][0] + " .child-image").attr("class", `child-image ${color_class}-border`);
                    // adding lines class in parent UL
                    $('#' + res[Object.keys(res)[0]][0]).parent().parent().addClass('lines');
                    $("#nodeModal").modal("hide");
                }
            }).catch((err) => {});
        });

        $("#nodeModal").on("shown.bs.modal", function () {
            $(".loading").css('visibility', 'hidden')
        });
        $("#nodeModal").on("hidden.bs.modal", function (e) {});

        $(".nav-link").on('click', function () {
            $(".img-container").css('visibility', 'hidden');
            $(".loading").css('visibility', 'visible')
            let nodeid = $("#nodeid").val();
            let image = $("#" + nodeid + " img").attr("src");
            let image_2 = $("#" + nodeid + " #image_2").length == 0 ? APP_URL + "/images/def.jpeg" : $("#" + nodeid + " #image_2").attr("src");
            setTimeout(() => {
                cropper.replace(image);
                second_cropper.replace(image_2);
                $(".img-container").css('visibility', 'visible');
                $(".loading").css('visibility', 'hidden')
            }, 1000)

        })
        $(".tree").on("click", ".node", function (event) {
            event.preventDefault();
            $(".loading").css('visibility', 'visible')
            if ($(this).attr("class").includes("root")) 
                $("#addparent").show();
             else 
                $("#addparent").hide();
            


            $("#nodeid").val($(this).attr("id"));
            let nodeid = $("#nodeid").val();
            let image = $("#" + nodeid + " img").attr("src");
            let image_2 = $("#" + nodeid + " #image_2").length == 0 ? APP_URL + "/images/def.jpeg" : $("#" + nodeid + " #image_2").attr("src");

            $('a[href="#user-1"]').attr('data-id', nodeid);
            $('a[href="#user-2"]').attr('data-id', nodeid);

            $("#nodename").val($(this).find(".nodetext").text());
            $("#designation").val($(this).find(".position")[0].innerText);
            $("#designation2").val($(this).find("#designation_second").val());

            setTimeout(() => {
                cropper.replace(image);
                second_cropper.replace(image_2);
            }, 200)
            $("#nodeModal").modal("show");
        });
    }, []);

    function valueByKey(value) {
        let obj = window.colorConfig;
        var key = Object.keys(obj).filter(function (key) {
            return obj[key] === value
        })[0];
        return key;
    }

    function manageTree(id) {
        const token = $("input[name='_token']").val();

        const new_org = {
            id: id,
            _token: token
        };

        const APP_URL = window.APP_URL;

        $.post(APP_URL + "/org/manage", new_org, function (data) {
            $(".tree").hide();

            $("#panel1").slideUp("slow", function () {
                $("#panel2").slideDown("slow", function () {
                    $(".tree").html(data);

                    $(".tree").show();
                });
            });
        });
    }
    function exportProject() {}
    function deleteTree() {}
    function _manageTree() {
        const token = $("input[name='_token']").val();

        const name = $("#node_name").val();

        const new_org = {
            node_name: name,
            root_id: 0,
            parent_id: 0,
            _token: token
        };

        const APP_URL = window.APP_URL;

        $.post(APP_URL + "/org/create", new_org, function (data) {
            if (data.code[0] == 0) {
                $("#error").text(data[Object.keys(data)[0]][0]);
            } else {
                $("#panel1").slideUp("slow", function () {
                    $("#panel2").slideDown("slow", function () {
                        $(".tree").append("<ul />");

                        $(".tree ul").append("<li />");

                        $(".tree ul li").append("<a class='root node' id='" + data[Object.keys(data)[0]][0] + "'> <img style='border-radius:40px' src='" + APP_URL + "/images/def.jpeg' width='70' > <br><div class='position'>SHASHI</div> <span class='nodetext'>" + name + "</span></a>");
                    });
                });
            }
        });
    }
    return <div></div>;
}
export default Manage;
if (document.getElementById("justToAttach")) {
    ReactDOM.render (
        <Manage/>,
        document.getElementById("justToAttach")
    );
}

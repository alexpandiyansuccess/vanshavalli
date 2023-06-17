import React, {useEffect} from "react";
import ReactDOM from "react-dom";
import $ from "jquery";
("use strict");

function Create() {
    useEffect(() => {
        $("#nodeModal").on("shown.bs.modal", function () {});

        $(".tree").on("click", ".node", function (event) {

            event.preventDefault();

            if ($(this).attr("class").includes("root")) 
                $("#addparent").show();
             else 
                $("#addparent").hide();
            

            $("#nodeid").val($(this).attr("id"));

            $("#nodename").val($(this).find(".nodetext").text());

            $("#nodeModal").modal("show");
        });
    }, []);
    function createNode() {
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
                window.location = APP_URL + "/manage-chart";
            }
        });
    }
    return (
        <button onClick={createNode}
            type="button"
            className="custom-button-create">
            <i className="fa fa-btn fa-plus-circle"></i>
            Create
        </button>
    );
}

export default Create;

if (document.getElementById("createButton")) {
    ReactDOM.render (
        <Create/>,
        document.getElementById("createButton")
    );
}

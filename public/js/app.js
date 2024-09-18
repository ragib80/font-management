Dropzone.autoDiscover = false;
var myDropzone = new Dropzone("#file-dropzone", {
    url: `${baseUrl}/fonts/upload`,
    paramName: "font",
    acceptedFiles: ".ttf",
    maxFilesize: 5,
    maxFiles: 1,
    //forceFallback: true,
    init: function() {
        var dz = this;
        dz.on("maxfilesexceeded", function(file) {
            dz.removeAllFiles();
            dz.addFile(file);
        });
        // dz.on("sending", function(file, xhr, formData) {
        //     console.log('Sending file:', file);
        // });
        dz.on("success", function(file, response) {

            $("#success-message").fadeIn().delay(3000).fadeOut();
            setTimeout(function() {
                dz.removeAllFiles(true);
            }, 3000);

        });

        dz.on("error", function(file, response) {
            console.error("Error: ", response);
        });
    }
});

$(document).ready(function () {

    $(".content-section").hide();
    const currentUrl = window.location.pathname;
    handleUrlChange(currentUrl);

    $("[data-url-link]").click(function (e) {
        e.preventDefault();
        const url = $(this).data("url-link");
        history.pushState(null, null, url);
        handleUrlChange(url);
    });

    window.onpopstate = function () {
        const currentUrl = window.location.pathname;
        handleUrlChange(currentUrl);
    };

    function handleUrlChange(url) {
        switch (url) {
            case `${baseUrl}/dashboard`:
                showSection("#dashboard-section");
                break;
            case `${baseUrl}/fonts/upload`:
                showSection("#font-upload-section");
                break;
            case `${baseUrl}/fonts/list`:
                showSection("#font-list-section");
                loadFontsList();
                break;
            case `${baseUrl}/font-groups/create`:
                showSection("#font-group-create-section");
                getFonts("select[name='font']");
                break;
            case `${baseUrl}/font-groups/list`:
                showSection("#font-group-list-section");
                loadFontGroupsList();
                break;
            default:
                showSection("#dashboard-section");
        }

        $(".nav-link.active").removeClass("active");
        $(`.nav-item > a[data-url-link*="${url}"]`).addClass("active");

        if (url.includes("/fonts/")) {
            $(".font_list_li").addClass("menu-open");
            $(".font_group_li").removeClass("menu-open");
        } else if (url.includes("/font-groups/")) {
            $(".font_group_li").addClass("menu-open");
            $(".font_list_li").removeClass("menu-open");
        } else {
            $(".font_list_li, .font_group_li").removeClass("menu-open");
        }
    }

    function showSection(sectionId) {
        $(".content-section").hide();
        $(sectionId).show();
    }

    let rowCounter = 1;

    function loadFontsList() {
        $.ajax({
            url: `${baseUrl}/fonts/list`,
            method: "GET",
            success: function (data) {
                if (data.code === 200) {
                    renderFontList(data);
                }
                else {
                    alert("An unexpected error occurred in feting data")
                }

            },
        });
    }

    function renderFontList(fonts) {
        $("#table_card").html("");
        let html =
            '<div class="table-responsive"><table class="table"><thead class="table-light"><tr><th>Font Name</th><th>Preview</th><th>Actions</th></tr></thead><tbody></div>';
        fonts.data.forEach(function (font) {
            const fontFamily = `font${font.id}`;
            const fontFile = font.file.split("/public/")[1];

            const fontFaceRule = `
              @font-face {
                  font-family: '${fontFamily}';
                  src: url('${baseUrl}/public/${fontFile}');
              }
          `;
            $("head").append(`<style>${fontFaceRule}</style>`);

            html += `<tr class="align-middle">
                  <td>${font.name}</td>
                  <td style="font-family: '${fontFamily}';">Example Style</td>
                  <td>
                  <a href="javascript:void(0)" class="text-danger dlt_btn" style="text-decoration: none;" data-id="${font.id}">Delete</a>
                     
                  </td>
              </tr>`;
        });

        html += "</tbody></table>";
        $("#table_card").html(html);
    }

   

    $(document).on("click", ".dlt_btn", function () {
        var id = $(this).data("id");
        $.ajax({
            url: `${baseUrl}/fonts/delete`,
            data: { id: id },
            type: "POST",
            success: function (response) {

                if (response.code === 200) {
                    loadFontsList();
                    alert(response.message);
                }
            },
            error: function () {
                alert("Failed to delete font.");
            },
        });
    });

    $("#addRow").on("click", function () {
        let newSelectId = `fontSelect_${rowCounter}`;
        rowCounter++;

        let newRow = `
      <div class="row mx-1 pt-4 pb-3 px-3 mb-1 font-row border border-1 rounded">
          <div class="col-md-3">
              <input type="text" class="form-control font-name" placeholder="Font Name">
          </div>
          <div class="col-md-3">
              <select id="${newSelectId}" class="form-select font-select" name="font">
                  <option selected>Select a Font</option>
              </select>
          </div>
          <div class="col-md-3">
              <input type="number" class="form-control specific-size" value="1.00" min="0" step="0.01" placeholder="Specific Size">
          </div>
          <div class="col-md-3">
              <div class="input-group mb-2">
                  <input type="number" class="form-control price-change" value="0" min="0" step="0.01" placeholder="Price Change">
                  <button type="button" class="btn btn-outline-danger remove-row ms-2">
                      <i class="bi bi-x"></i>
                  </button>
              </div>
          </div>
      </div>`;

        $("#fontGroupForm").append(newRow);

        getFonts(`#${newSelectId}`);
    });

    $(document).on("click", ".remove-row", function () {
        $(this).closest(".font-row").remove();
    });

    function loadFontGroupsList() {
        $.ajax({
            url: `${baseUrl}/font-groups/list`,
            method: "GET",
            success: function (response) {
                if (response.code === 200) {
                    renderFontGroupsList(response.data);
                }
                else {
                    alert("An error occurred while feting the list.");
                }
            },
            error: function (xhr, status, error) {
                alert("An error occurred while feting the list data from server.");
                console.error("Response Text:", xhr.responseText);
            },
        });
    }

    function renderFontGroupsList(groups) {
        $("#font-group-table-card").html("");
        let html = `<div class="table-responsive"><table class="table"><thead class="table-light"><tr><th>NAME</th><th>FONTS</th><th>COUNT</th><th>Actions</th></tr></thead><tbody></div>`;
        groups.forEach(function (group) {
            html += `<tr>
                  <td>${group.group_name}</td>
                  <td>${group.fonts}</td>
                  <td>${group.font_count}</td>
                  <td>
                    <a href="javascript:void(0)" class="text-primary group_edt_btn" style="text-decoration: none;" data-id="${group.group_id}">Edit </a>&nbsp;
                    <a href="javascript:void(0)" class="text-danger group_dlt_btn" style="text-decoration: none;" data-id="${group.group_id}">Delete</a>
                  </td>
              </tr>`;
        });
        html += "</tbody></table>";
        $("#font-group-table-card").html(html);
    }

    function getFonts(elementToAppend, value = false) {
        $.ajax({
            url: `${baseUrl}/get-fonts`,
            method: "GET",
            success: function (response) {
                if (response.code === 200) {
                    $(elementToAppend).empty().append(
                        $("<option>", {
                            value: "",
                            text: "Select a Font",
                            selected: true,
                            disabled: true,
                        })
                    );
                    $.each(response.data, function (index, font) {
                        $(elementToAppend).append(
                            $("<option>", {
                                value: font.id,
                                text: font.name,
                                selected: value == font.id ? true : false,
                            })
                        );

                        if (value && font.id === value) {
                            $(elementToAppend).prop("selected", true);
                        }
                    });
                }
                else {
                    alert("An error occurred while feting the list.");
                }

            },
            error: function (xhr, status, error) {
                console.error("Response Text:", xhr.responseText);
            },
        });
    }

    $("#create-font-group").on("click", function (e) {
        e.preventDefault();
        var groupTitle = $("#groupTitle").val();
        var fontData = [];
        var fontRows = $("#fontGroupForm .font-row");

        if (fontRows.length < 2) {
            alert("To create a group, you must select at least two fonts.");
            return;
        }

        fontRows.each(function () {
            var fontName = $(this).find(".font-name").val();
            var selectedFont = $(this).find(".font-select").val();
            if (selectedFont !== "Select a Font") {
                fontData.push({
                    font_name: fontName,
                    font_ids: parseInt(selectedFont),
                });
            }
        });

        var selectedFonts = fontData.map(function (item) {
            return item.font_ids;
        });

        var uniqueSelectedFonts = [...new Set(selectedFonts)];

        if (uniqueSelectedFonts.length < 2) {
            alert("Please select at least two unique fonts to create a group.");
            return;
        }

        var formData = {
            group_name: groupTitle,
            fonts: fontData,
        };

        $.ajax({
            url: `${baseUrl}/font-groups/create`,
            method: "POST",
            data: JSON.stringify(formData),
            contentType: "application/json",
            success: function (response) {
                if (response.code === 200) {
                    $("#fontGroupForm")[0].reset();
                    removeEmptySelectRows(".font-select");
                    alert("Font group created successfully!");
                } else {
                    alert(response.message);
                }
            },
            error: function (xhr, status, error) {
                alert("An error occurred while creating the font group.");
                console.log("Response Text:", xhr.responseText);
            },
        });
    });

    let group_id;
    let editRowCounter = 0;

    $(document).on("click", ".group_edt_btn", function () {
        var id = $(this).data("id");
        group_id = id;

        $.ajax({
            url: `${baseUrl}/font-groups/edit`,
            data: { id: id },
            type: "GET",
            success: function (response) {
                $("#font-group-edit-modal").modal("show");

                $("#editGroupTitle").empty().val(response.data[0].group_name);

                if (response.data && response.data[0] && response.data[0].fonts) {
                    let html = "";
                    response.data[0].fonts.forEach(function (fontGroup) {
                        html += `
                            <div class="row mx-1 pt-4 pb-3 px-3 mb-1 font-row border border-1 rounded">
                                <div class="col-md-3">
                                    <input type="text" id="editFontName" value="${fontGroup.font_name}" class="form-control font-name" placeholder="Font Name">
                                </div>
                                <div class="col-md-3">
                                    <select id="editFontSelect_${editRowCounter}" class="form-select edit-font-select" name="editFont">
                                        <option selected disable>Select a Font</option>
                                
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" class="form-control specific-size" value="1.00" min="0" step="0.01" placeholder="Specific Size">
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control price-change" value="0" min="0" step="0.01" placeholder="Price Change">
                                        <button type="button" class="btn btn-outline-danger remove-row ms-2">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>`;

                        $("#font-group-ajax-div").html("");
                        $("#font-group-ajax-div").empty().html(html);

                        getFonts(`#editFontSelect_${editRowCounter}`, fontGroup.font_id);
                        editRowCounter++;
                    });
                    $("#modal_addRow").off("click");
                    $("#modal_addRow").on("click",function () {
                        let newSelectId = `editFontSelect_${editRowCounter}`;
                        editRowCounter++;

                        let newRow = `
                            <div class="row mx-1 pt-4 pb-3 px-3 mb-1 font-row border border-1 rounded">
                                <div class="col-md-3">
                                    <input type="text" class="form-control font-name" placeholder="Font Name">
                                </div>
                                <div class="col-md-3">
                                    <select id="${newSelectId}" class="form-select edit-font-select" name="editFont">
                                        <option selected>Select a Font</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" class="form-control specific-size" value="1.00" min="0" step="0.01" placeholder="Specific Size">
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control price-change" value="0" min="0" step="0.01" placeholder="Price Change">
                                        <button type="button" class="btn btn-outline-danger edit-remove-row ms-2">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>`;

                        $("#editFontGroupForm").append(newRow);

                        getFonts(`#${newSelectId}`);
                    });
                    $(document).on("click", ".edit-remove-row", function () {
                        $(this).closest(".font-row").remove();
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error("Response Text:", xhr.responseText);
            },
        });
    });

    $("#update-font-group").on("click", function (e) {
        e.preventDefault();
        var groupTitle = $("#editGroupTitle").val();
        var fontData = [];
        var fontRows = $("#editFontGroupForm").find(".font-row");

        if (fontRows.length < 2) {
            alert("To create a group, you must select at least two fonts.");
            return;
        }

        fontRows.each(function () {
            var fontName = $(this).find(".font-name").val();
            var selectedFont = $(this).find(".edit-font-select").val();

            if (fontName && selectedFont && selectedFont !== "Select a Font") {
                fontData.push({
                    font_name: fontName,
                    font_ids: parseInt(selectedFont),
                });
            }
        });

        var selectedFonts = fontData.map(function (item) {
            return item.font_ids;
        });

        var uniqueSelectedFonts = [...new Set(selectedFonts)];
      
        if (uniqueSelectedFonts.length < 2) {
            alert("Please select at least two unique fonts to create a group.");
            return;
        }

        var formData = {
            group_name: groupTitle,
            fonts: fontData,
            group_id: group_id,
        };

        $.ajax({
            url: `${baseUrl}/font-groups/update`,
            method: "POST",
            data: JSON.stringify(formData),
            contentType: "application/json",
            success: function (response) {
                if (response.code === 200) {
                    alert(response.message);
                    loadFontGroupsList();
                    $("#font-group-edit-modal").modal("hide");
                    $("#editFontGroupForm")[0].reset();
                    $(".edit-font-select").each(function () {
                        $(this).val("").trigger("change");
                        removeEmptySelectRows(".edit-font-select");
                    });
                    $("#font-group-ajax-div").html("");
                    editRowCounter = 1;
                }
                else {
                    alert(response.message)
                }
            },
            error: function (xhr, status, error) {
                alert("An unexpected error occurred. Please try again.");
            },
        });
    });

    $(document).on("click", ".group_dlt_btn", function () {
        var id = $(this).data("id");
        $.ajax({
            url: `${baseUrl}/font-groups/delete`,
            data: { id: id },
            type: "POST",
            success: function (response) {

                if (response.code === 200) {
                    loadFontGroupsList();
                    alert(response.message);
                }
            },
            error: function () {
                alert("Failed to delete font.");
            },
        });
    });

    function removeEmptySelectRows(element) {
        $(".font-row").each(function (index) {
            if (index === 0) {
                return;
            }

            const select = $(this).find(element);
            if (select.val() === null || select.val() === "") {
                $(this).remove();
            }
        });
    }
});

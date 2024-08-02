$(function () {

    var authToken = localStorage.getItem('auth_token');
    var currentPage = 1;

    // $.ajax({
    //     url: '/api/v1/websites',
    //     type: 'GET',
    //     headers: {
    //         'Authorization': 'Bearer ' + authToken
    //     },
    //     success: function(response) {
    //         console.log(response);
    //     },
    //     error: function(jqXHR) {
    //         if(jqXHR.status == '401'){
    //             window.location.href = '/auth/signin';
    //         }
    //     }
    // });

    function loadData(page) {
        $.ajax({
            url: '/api/v1/websites?page=' + page,
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + authToken
            },
            success: function (response) {
                renderList(response.data);
                renderPagination(response);
                currentPage = response.current_page;
            },
            error: function (jqXHR) {
                if (jqXHR.status == '401') {
                    window.location.href = '/auth/signin';
                }
            }
        });
    }


    function renderList(data) {
        var listContainer = $('#list-container');
        listContainer.empty();

        data.forEach(function (item) {

            var listItem = `
                <div class="list-item" data-id="${item.id}">
                    <span><strong>${item.id}</strong></span>
                    <span>${item.url}</span>
                    <span>Created At: ${item.created_at}</span>
                    <button class="edit-btn">Edit</button>
                    <button class="delete-btn">Delete</button>
                    <button class="report-btn">Report</button>
                </div>
            `;
            listContainer.append(listItem);
        });

        $('.edit-btn').click(handleEdit);
        $('.delete-btn').click(handleDelete);
        $('.report-btn').click(handleReport);
    }

    function renderPagination(pagination) {
        var paginationContainer = $('#pagination-container');
        paginationContainer.empty();

        var paginationHtml = '';

        let paginationLinks = pagination.meta.links;
        
        paginationLinks.forEach(function (link) {
            if (link.url) {
                console.log(link.label != "Next &raquo");
                console.log(link.label);
                if (link.label !== "Next &raquo;" && link.label !== "&laquo; Previous") {
                    paginationHtml += `<button class="page-btn ${link.active ? 'active' : ''}" data-page="${link.label}">${link.label}</button>`;
                }
            }
        });

        paginationContainer.html(paginationHtml);

        $('.page-btn').click(handlePageClick);
    }

    function handlePageClick() {
        var page = $(this).data('page');
        loadData(page);
    }


    function handleEdit() {
        var listItem = $(this).closest('.list-item');
        var id = listItem.data('id');
        var newUrl = prompt('Введите новый URL:', listItem.find('a').text());

        if (newUrl) {
            $.ajax({
                url: '/api/v1/websites/edit/' + id,
                method: 'PUT',
                headers: {
                    'Authorization': 'Bearer ' + authToken
                },
                data: { url: newUrl },
                success: function () {
                    loadData(currentPage);
                },
                error: function (jqXHR) {
                    if (jqXHR.status == '401') {
                        window.location.href = '/auth/signin';
                    }
                }
            });
        }
    }

    function handleReport() {
        var listItem = $(this).closest('.list-item');
        var id = listItem.data('id');

        $("#myModal").modal('show');

        if (id) {
            $.ajax({
                url: `/api/v1/websites/${id}/report`,
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + authToken
                },
                success: function (response) {
                    let data = response.data;
                    let total = response.total;
                    let html = `<table class="table ">
                    <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">CPM</th>
                                    <th scope="col">Impressions</th>
                                    <th scope="col">Revenue</th>
                                </tr>
                                </thead>
                                <tbody>`;

                    for (let date in data) {
                        if (data.hasOwnProperty(date)) {
                            let item = data[date];
                            html += `<tr>
                                <td>${date}</td>
                                <td>${item.cpm}</td>
                                <td>${item.impressions}</td>
                                <td>${item.revenue}</td>
                            </tr>`;
                        }
                    }

                    html += `</tbody> </table>`;
                    html += `<span>Total</span>`;
                    html += `<div>
                        <div>CPM: ${total.cpm}</div>
                        <div>Impressions: ${total.impressions}</div>
                        <div>Sum: ${total.sum}</div>
                    </div>`;

                    $("#modal-body").html(html);
                },
                error: function (jqXHR) {
                    if (jqXHR.status == '401') {
                        window.location.href = '/auth/signin';
                    }
                }
            });
        }

    }

    function handleDelete() {
        var listItem = $(this).closest('.list-item');
        var id = listItem.data('id');

        if (confirm('Вы уверены, что хотите удалить этот элемент?')) {
            $.ajax({
                url: `/api/v1/websites/destroy/${id}`,
                method: 'DELETE',
                headers: {
                    'Authorization': 'Bearer ' + authToken
                },
                success: function () {
                    loadData(currentPage);
                },
                error: function (jqXHR) {
                    if (jqXHR.status == '401') {
                        window.location.href = '/auth/signin';
                    }
                }
            });
        }
    }

    function handleAdd() {
        var newUrl = prompt('Please enter new URL:');

        if (newUrl) {
            $.ajax({
                url: '/api/v1/websites/add',
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + authToken
                },
                data: { url: newUrl },
                success: function () {
                    loadData(currentPage);
                },
                error: function (jqXHR) {
                    if (jqXHR.status == '401') {
                        window.location.href = '/auth/signin';
                    }
                }
            });
        }
    }


    loadData(currentPage);
    $('#add-btn').click(handleAdd);


});



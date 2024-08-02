$(function () {

    var authToken = localStorage.getItem('auth_token');

    function loadDataAllReport() {
        $.ajax({
            url: '/api/v1/report/getAll',
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + authToken
            },
            success: function (response) {
                createTableAllData(response.data);
                // renderList(response.data);
                // renderPagination(response);
                // currentPage = response.current_page;
            },
            error: function (jqXHR) {
                if (jqXHR.status == '401') {
                    window.location.href = '/auth/signin';
                }
            }
        });
    }

    function loadData() {
        $.ajax({
            url: '/api/v1/report/',
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + authToken
            },
            success: function (response) {
                createTable(response);
                // renderList(response.data);
                // renderPagination(response);
                // currentPage = response.current_page;
            },
            error: function (jqXHR) {
                if (jqXHR.status == '401') {
                    window.location.href = '/auth/signin';
                }
            }
        });
    }

    function createTable(response) {
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

            $('#list-container').html(html)

    }

    function createTableAllData(data) {

        let html = `
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">website_id</th>
                        <th scope="col">revenue</th>
                        <th scope="col">impressions</th>
                        <th scope="col">clicks</th>
                        <th scope="col">date</th>
                    </tr>
                </thead>
                <tbody>`;
        data.forEach(function (item) {
            html += `
                    <tr>
                        <td>${item.id}</td>
                        <td>${item.website_id}</td>
                        <td>${item.revenue}</td>
                        <td>${item.impressions}</td>
                        <td>${item.clicks}</td>
                        <td>${item.date}</td>
                    </tr>
                `
        })
        html += `</tbody>
            </table>`;

        $('#list-container').html(html)

    }

    $(document).on('submit', '#add-report-form', function (e) {
        e.preventDefault();
        // console.log($(this).serialize())
        //         var formData = new FormData(this);

        $('#submitForm').prop('disabled', true).text('Loading...');

        $.ajax({
            url: '/api/v1/report/add',
            method: 'POST',
            data: $(this).serialize(),
            headers: {
                'Authorization': 'Bearer ' + authToken
            },
            success: function (response) {
                loadData()
                $("#add-report-modal").modal('hide');
            },
            error: function (jqXHR) {
                if (jqXHR.status == '401') {
                    window.location.href = '/auth/signin';
                }

                if (jqXHR.status == '409') {
                    alert('Error: ' + jqXHR.responseJSON.message);
                    window.location.reload();
                }
            }
        });
    });

    $('#show-report-by-date').on('click', function (e) {
        loadData();
    });

    $('#show-report').on('click', function (e) {
        loadDataAllReport();
    });

    $('#add-new-report').on('click', function (e) {
        $("#add-report-modal").modal('show');
    });

    // function renderList(data) {
    //     var listContainer = $('#list-container');
    //     listContainer.empty();

    //     data.forEach(function (item) {
    //         var listItem = `
    //             <div class="list-item" data-id="${item.id}">
    //                 <span><strong>${item.id}</strong></span>
    //                 <span>${item.url}</span>
    //                 <span>Created At: ${item.created_at}</span>
    //                 <button class="edit-btn">Edit</button>
    //                 <button class="delete-btn">Delete</button>
    //                 <button class="report-btn">Report</button>
    //             </div>
    //         `;
    //         listContainer.append(listItem);
    //     });

    //     $('.edit-btn').click(handleEdit);
    //     $('.delete-btn').click(handleDelete);
    //     $('.report-btn').click(handleReport);
    // }

    // function renderPagination(pagination) {
    //     var paginationContainer = $('#pagination-container');
    //     paginationContainer.empty();

    //     var paginationHtml = '';

    //     if (pagination.prev_page_url) {
    //         paginationHtml += `<button class="page-btn" data-page="${pagination.current_page - 1}">Previous</button>`;
    //     }

    //     pagination.links.forEach(function (link) {
    //         if (link.url) {
    //             paginationHtml += `<button class="page-btn ${link.active ? 'active' : ''}" data-page="${link.label}">${link.label}</button>`;
    //         }
    //     });

    //     if (pagination.next_page_url) {
    //         paginationHtml += `<button class="page-btn" data-page="${pagination.current_page + 1}">Next</button>`;
    //     }

    //     paginationContainer.html(paginationHtml);

    //     $('.page-btn').click(handlePageClick);
    // }

    // function handlePageClick() {
    //     var page = $(this).data('page');
    //     loadData(page);
    // }


    // function handleEdit() {
    //     var listItem = $(this).closest('.list-item');
    //     var id = listItem.data('id');
    //     var newUrl = prompt('Введите новый URL:', listItem.find('a').text());

    //     if (newUrl) {
    //         $.ajax({
    //             url: '/api/v1/websites/edit/' + id,
    //             method: 'PUT',
    //             headers: {
    //                 'Authorization': 'Bearer ' + authToken
    //             },
    //             data: { url: newUrl },
    //             success: function () {
    //                 loadData(currentPage);
    //             },
    //             error: function (jqXHR) {
    //                 if (jqXHR.status == '401') {
    //                     window.location.href = '/auth/signin';
    //                 }
    //             }
    //         });
    //     }
    // }

    // function handleReport() {
    //     var listItem = $(this).closest('.list-item');
    //     var id = listItem.data('id');

    //     $("#myModal").modal('show');

    //     if (id) {
    //         $.ajax({
    //             url: `/api/v1/websites/${id}/report`,
    //             method: 'GET',
    //             headers: {
    //                 'Authorization': 'Bearer ' + authToken
    //             },
    //             success: function (response) {
    //                 let data = response.data;
    //                 let total = response.total;
    //                 let html = `<table class="table ">
    //                 <thead>
    //                             <tr>
    //                                 <th scope="col">Date</th>
    //                                 <th scope="col">CPM</th>
    //                                 <th scope="col">Impressions</th>
    //                                 <th scope="col">Revenue</th>
    //                             </tr>
    //                             </thead>
    //                             <tbody>`;

    //                 for (let date in data) {
    //                     if (data.hasOwnProperty(date)) {
    //                         let item = data[date];
    //                         html += `<tr>
    //                             <td>${date}</td>
    //                             <td>${item.cpm}</td>
    //                             <td>${item.impressions}</td>
    //                             <td>${item.revenue}</td>
    //                         </tr>`;
    //                     }
    //                 }

    //                 html += `</tbody> </table>`;
    //                 html += `<span>Total</span>`;
    //                 html += `<div>
    //                     <div>CPM: ${total.cpm}</div>
    //                     <div>Impressions: ${total.impressions}</div>
    //                     <div>Sum: ${total.sum}</div>
    //                 </div>`;

    //                 $("#modal-body").html(html);
    //             },
    //             error: function (jqXHR) {
    //                 if (jqXHR.status == '401') {
    //                     window.location.href = '/auth/signin';
    //                 }
    //             }
    //         });
    //     }

    // }

    // function handleDelete() {
    //     var listItem = $(this).closest('.list-item');
    //     var id = listItem.data('id');

    //     if (confirm('Вы уверены, что хотите удалить этот элемент?')) {
    //         $.ajax({
    //             url: `/api/v1/websites/destroy/${id}`,
    //             method: 'DELETE',
    //             headers: {
    //                 'Authorization': 'Bearer ' + authToken
    //             },
    //             success: function () {
    //                 loadData(currentPage);
    //             },
    //             error: function (jqXHR) {
    //                 if (jqXHR.status == '401') {
    //                     window.location.href = '/auth/signin';
    //                 }
    //             }
    //         });
    //     }
    // }

    // function handleAdd() {
    //     var newUrl = prompt('Please enter new URL:');

    //     if (newUrl) {
    //         $.ajax({
    //             url: '/api/v1/websites/add',
    //             method: 'POST',
    //             headers: {
    //                 'Authorization': 'Bearer ' + authToken
    //             },
    //             data: { url: newUrl },
    //             success: function () {
    //                 loadData(currentPage);
    //             },
    //             error: function (jqXHR) {
    //                 if (jqXHR.status == '401') {
    //                     window.location.href = '/auth/signin';
    //                 }
    //             }
    //         });
    //     }
    // }


    // $('#add-btn').click(handleAdd);
    loadData();


});



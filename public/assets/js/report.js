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

    loadData();


});



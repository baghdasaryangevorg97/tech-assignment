<!DOCTYPE html>
<html>

<head>
    <title>Report</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="{{ asset('assets/css/website.css') }}" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/js/report.js') }}"></script>
</head>

<body>
    <div class="modal fade" id="add-report-modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div id='modal-body' class="modal-body text-center">
                    <form method="POST" id="add-report-form" >
                        <div class="form-row">
                            <div class="col p-2">
                                <input type="number" class="form-control" name="website_id" placeholder="website_id" required>
                            </div>
                            <div class="col p-2">
                                <input type="number" class="form-control" name="revenue" placeholder="revenue" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col p-2">
                                <input type="number" class="form-control" name="impressions" placeholder="impressions" required>
                            </div>
                            <div class="col p-2">
                                <input type="number" class="form-control" name="clicks" placeholder="clicks" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col p-2">
                                <input type="string" class="form-control" name="date" placeholder="Enter date format YYYY-MM-DD" required>
                            </div>
                            <div class="col p-2">
                                <button type="submit" id="submitForm" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container site-container">
        <div>
            <button class="btn btn-primary"><a href="{{ route('websites') }}"
                    style="text-decoration: none; color: white;">Websites</a></button>
            <button id="add-new-report" class="btn btn-primary">Add New Report</button>
            <button id="show-report-by-date" class="btn btn-primary">Show Report by date</button>
            <button id="show-report" class="btn btn-primary">Show Report</button>
        </div>
        <div id="list-container"></div>
    </div>

</body>

</html>

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
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div id='modal-body' class="modal-body text-center"></div>
            </div>
        </div>
    </div>

    <div class="container site-container">
        <div>
            <button id="add-btn" class="btn btn-primary">Add New Item</button>
            <button class="btn btn-primary"><a href="{{ route('report') }}" style="text-decoration: none; color: white;" >Report</a></button>
        </div>
        <div id="list-container"></div>
        <div id="pagination-container"></div>
    </div>

</body>

</html>

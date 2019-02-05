<head>

	<!-- At.js styles -->
	<link rel="stylesheet" href="/path/to/jquery.atwho.css">
	
</head>

<body>
	<textarea class="form-control" rows="5" id="autocomplete-textarea" name="body"></textarea>
	
	<!-- jQuery -->
	<script src="http://code.jquery.com/jquery.js"></script>

	<!-- Caret.js -->
	<script src="/path/to/jquery.caret.js"></script>

	<!-- At.js -->
	<script src="/path/to/jquery.atwho.js"></script>
</body>

<script>
$(function() {
    $('#autocomplete-textarea').atwho({
        at: '#',
        // Adjust the delay in milliseconds to throttle requests to the server
        delay: 500,
        callbacks: {
            remoteFilter: function(query, callback) {
                $.getJSON('/api/tags', {tag: query}, function(tags) {
                    callback(tags);
                });
            }
        }
    })
});
</script>
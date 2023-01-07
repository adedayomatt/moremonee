<html>
<body>
    <div style="height: 100vh; display: flex; align-items: center; justify-content: center">
        <div style="text-align: center">
            <p>{{ $data->txRef  }}</p>
            <h1>{{ $data->status  }}</h1>
            <p>You can now close this window</p>
        </div>
    </div>
    <script>
        parent.postMessage(@json($data));
    </script>
</body>
</html>

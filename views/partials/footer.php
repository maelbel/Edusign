        </div>
        <script src="./src/js/jquery.js"></script>
        <script src="./src/js/bootstrap/bootstrap.js"></script>
        <script type="text/javascript">
            const myModal = document.getElementById('addClassModal');
            const myInput = document.getElementById('addClassBtn');

            myModal.addEventListener('shown.bs.modal', () => {
                myInput.focus();
            })
        </script>
    </body>
</html>
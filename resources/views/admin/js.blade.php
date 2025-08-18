 <!-- Bootstrap bundle JS -->
  <script src="{{asset('adminui/assets/js/bootstrap.bundle.min.js')}}"></script>
  <!--plugins-->
  <script src="{{asset('adminui/assets/js/jquery.min.js')}}"></script>
  <script src="{{asset('adminui/assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
  <script src="{{asset('adminui/assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
  <script src="{{asset('adminui/assets/plugins/easyPieChart/jquery.easypiechart.js')}}"></script>
  <script src="{{asset('adminui/assets/plugins/peity/jquery.peity.min.js')}}"></script>
  <script src="{{asset('adminui/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
  <script src="{{asset('adminui/assets/js/pace.min.js')}}"></script>
  <script src="{{asset('adminui/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
	<script src="{{asset('adminui/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
  <script src="{{asset('adminui/assets/plugins/apexcharts-bundle/js/apexcharts.min.js')}}"></script>
  <script src="{{asset('adminui/assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('adminui/assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{asset('adminui/assets/js/table-datatable.js')}}"></script>
  <!--app-->
  <script src="{{asset('adminui/assets/js/app.js')}}"></script>
  <script src="{{asset('adminui/assets/js/index.js')}}"></script>

  <script>
     new PerfectScrollbar(".best-product")
     new PerfectScrollbar(".top-sellers-list")
  </script>

  <!--JQUERY PHONE MASK-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
  $('#phone').mask('+44 0000 000 000');
</script>
  


<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    toastr.options = {
        "positionClass": "toast-top-right",
        "timeOut": "5000"
         "progressBar": true, // ✅ This enables the bottom line

    };
</script>
<script>
    @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
    @elseif(Session::has('error'))
        toastr.error("{{ Session::get('error') }}");
    @elseif(Session::has('info'))
        toastr.info("{{ Session::get('info') }}");
    @elseif(Session::has('warning'))
        toastr.warning("{{ Session::get('warning') }}");
    @endif
</script>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const emailField = document.querySelector('input[name="email"]');
    const passwordField = document.getElementById('password');

    emailField.addEventListener('input', function () {
        if (emailField.value.length > 3) {
            // Generate random password
            const randomPass = Math.random().toString(36).slice(-8); // 8 chars
            passwordField.value = randomPass;
        } else {
            passwordField.value = '';
        }
    });
});
</script>




{{-- JS to Show Preview --}}

<script>
    document.getElementById('pictures').addEventListener('change', function (event) {
        let previewContainer = document.getElementById('picture-preview');
        previewContainer.innerHTML = ''; // Clear previous previews

        Array.from(event.target.files).forEach(file => {
            if (file.type.startsWith('image/')) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    let img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('img-thumbnail');
                    img.style.width = '30px';
                    img.style.height = '30px';
                    img.style.objectFit = 'cover';
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>





<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Simplified Select2 initialization
        $('.select2-searchable').select2({
            width: '100%',
            placeholder: 'Search...',
            minimumInputLength: 1
        });
    });
</script>


<script>
document.querySelectorAll('.preview-image').forEach(img => {
    img.addEventListener('click', function() {
        document.getElementById('previewImg').src = this.src;
        document.getElementById('imagePreviewModal').style.display = 'flex';
    });
});

document.getElementById('imagePreviewModal').addEventListener('click', function() {
    this.style.display = 'none';
});
</script>





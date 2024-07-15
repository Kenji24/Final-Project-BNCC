<!-- resources/views/partials/footer.blade.php -->

<footer class="bg-body-tertiary py-4 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <h5 class="text-uppercase">CUNNY STORE</h5>
                <p class="text-muted">Otaku techs save the world =w=</p>
            </div>
            <div class="col-lg-4 mb-4 mb-lg-0">
                <h5 class="text-uppercase">Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('home') }}" class="text-muted">Home</a></li>
                    <li><a href="{{ route('product.menu') }}" class="text-muted">Product</a></li>
                    <li><a href="about" class="text-muted">About Us</a></li>
                </ul>
            </div>
            <div class="col-lg-4">
                <h5 class="text-uppercase">Contact Us</h5>
                <p class="text-muted">Jalan Awooga, Kota Awikwok, Indonesia</p>
                <p class="text-muted">Email: support@cunnystore.com</p>
                <p class="text-muted">Phone: (123) 456-7890</p>
                <div class='container'>
                    <a href="#" class="text-muted me-2"><i class="bi bi-facebook"></i></a>
                    <label>Cunny Store Official</label>
                    <br>
                    <a href="#" class="text-muted me-2"><i class="bi bi-twitter"></i></a>
                    <label>@cunnystore_official</label>
                    <br>
                    <a href="#" class="text-muted me-2"><i class="bi bi-instagram"></i></a>
                    <label>@cunny_store</label>
                </div>
            </div>
        </div>
    </div>
</footer>

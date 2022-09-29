<div class="footer">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<h3>Information</h3>
				<ul class="ps-0">
					<li><a href="">Contact us</a></li>
					<li><a href="">Terms & conditions</a></li>
					<li><a href="">Track your order</a></li>
					<li><a href="">Our guarantee</a></li>
					<li><a href="">Guide des tailles</a></li>
				</ul>
			</div>
			<div class="col-md-3">
				<h3>Categories</h3>
				<ul class="ps-0">
					<li><a href="">Earring</a></li>
					<li><a href="">Necklace</a></li>
					<li><a href="">Bracelet</a></li>
					<li><a href="">Daimond rings</a></li>
					<li><a href="">Jewelry box</a></li>
				</ul>
			</div>
			<div class="col-md-3">
				<h3>Company</h3>
				<ul class="ps-0">
					<li><a href="">Instagram</a></li>
					<li><a href="">Contact</a></li>
					<li><a href="">Journal</a></li>
					<li><a href="">Media</a></li>
					<li><a href="">Press</a></li>
				</ul>
			</div>
			<div class="col-md-3">
				<h3>Contact info</h3>
				<ul class="ps-0">
					<li><a href="">Phone: +1 234 567 890</a></li>
					<li><a href="">Email: info@domain.com</a></li>
					<li><a href="">401 Broadway, 24th Floor,</a></li>
					<li><a href="">Orchard View, London, UK</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="mainMenu footerBtm">
	<div class="container">
		<div class="row">
			<div class="col-md-5">
				<ul class="ps-0 mt-4">
					<li><a href="#" class="fs-6">© 2022 Theme Powered by gianzz</a></li>
				</ul>
			</div>
			<div class="col-md-2">
				<div class="logo">
					<img src="{{ asset('frontend/images/bannertext.png') }}">
				</div>
			</div>
			<div class="col-md-5 text-end">
				<ul class="ps-0 mt-4">
					<li><a href="#"><i class="bi bi-facebook"></i></a></li>
					<li><a href="#"><i class="bi bi-instagram"></i></a></li>
					<li><a href="#"><i class="bi bi-twitter"></i></a></li>
					<li><a href="#"><i class="bi bi-youtube"></i></a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="{{ asset('frontend/js/stellarnav.min.js') }}"></script>


<script type="text/javascript">
	jQuery(document).ready(function($) {
		jQuery('.stellarnav').stellarNav({
			theme: 'dark',
			breakpoint: 960,
			position: 'right',
			phoneBtn: '18009997788',
			locationBtn: 'https://www.google.com/maps'
		});
	});
</script>

<script>
	const imgs = document.querySelectorAll('.img-select a');
const imgBtns = [...imgs];
let imgId = 1;

imgBtns.forEach((imgItem) => {
    imgItem.addEventListener('click', (event) => {
        event.preventDefault();
        imgId = imgItem.dataset.id;
        slideImage();
    });
});

function slideImage(){
    const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;

    document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
}

window.addEventListener('resize', slideImage);
</script>
<script>
	const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () =>
container.classList.add('right-panel-active'));

signInButton.addEventListener('click', () =>
container.classList.remove('right-panel-active'));
</script>
</html>
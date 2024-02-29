<x-layout>
  <div class="container my-5">
    <div class="row">
      <div class="col-12 col-md-6">
        <h2>{{ $snowboards['Tipo'] }}</h2>
        <p>{{ $snowboards['descrizione'] }}</p>
        <p>Prezzo: ${{ $snowboards['price'] }}</p>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Immagini</button>
      </div>
    </div>
  </div>
        

      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-center mb-5">
              <div id="carouselExampleFade" class="carousel slide carousel-fade">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS-bueNRFZYBEWXrABWYoTiyYtt4SK82GC7QQ&usqp=CAU" class="img-fluid" alt="img/Romeo.jpg">
                  </div>
                  <div class="carousel-item">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSS2RCLUPq1JgEPmHByabXOF8kuno6klS2moQ&usqp=CAU" class="img-fluid" alt="img/Romeo.jpg">
                  </div>
                  <div class="carousel-item">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSZScR8dZx0KDQ5ACuC9c8f-y9Ou2d4AC34Zg&usqp=CAU" class="img-fluid" alt="img/Romeo.jpg">
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
  </x-layout>

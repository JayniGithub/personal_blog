<div>
    
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-auto">
                <span class="avatar avatar-md" style="background-image: url({{$author->picture}})"></span>
            </div>
            <div class="col-md-8 mb-2 mb-md-0">
                <h2 class="page-title">{{$author->name}}</h2>
                <div class="page-subtitle">
                <div class="row">
                    <div class="col-auto">
                        <a href="#" class="text-reset">@ {{$author->username}} | {{$author->authortype->name}}</a>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-auto d-md-flex">
                <input type="file" name="file" id="changeAuthorPictureFile" class="d-none" 
                onchange="this.dispatchEvent(new InputEvent('input'))">
                <a href="#" class="btn btn-primary" onclick="event.preventDefault();document.getElementById('changeAuthorPictureFile').click();">
                Change Picture
                </a>
            </div>
        </div>
    </div>

</div>

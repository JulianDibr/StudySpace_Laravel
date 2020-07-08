<div class="row mx-0 h-100">
    <div class="col-12 col-lg-6 text-center pt-2 mt-3 mb-4 my-lg-0">
        <div class="row">
            <div class="col-12 col-lg-6 offset-lg-3 text-center">
                <span class="text-white my-2">Gibt es Probleme?<br>Kontaktiere uns:</span>

                <form action="{{route('home.supportMessage')}}" method="POST">
                    @csrf
                    <div class="row my-2">
                        <div class="col-12">
                            <input type="text" class="contact-input" name="email" placeholder="E-Mail Adresse eingeben">
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-12">
                            <textarea class="resize-none contact-input" name="message" placeholder="Nachricht eingeben"></textarea>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-12">
                            <button class="btn white-standard-btn">Absenden</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6 my-auto text-center">
        <span class="text-white">
            Besuche uns auf:
            <a href="https://www.facebook.com/" class="btn mr-1 text-white"><i class="fab fa-2x fa-facebook-square"></i></a>
            <a href="https://www.instagram.com/" class="btn mr-1 text-white"><i class="fab fa-2x fa-instagram-square"></i></a>
            <a href="https://www.twitter.com/" class="btn text-white"><i class="fab fa-2x fa-twitter-square"></i></a>
        </span>
        <br>
        <br>
        <span class="text-white">
            <button type="button" class="btn mr-2 text-white" data-toggle="modal" data-target="#impressum-modal">Impressum</button><span>|</span>
            <button type="button" class="btn mr-2 text-white" data-toggle="modal" data-target="#agb-modal">AGB</button><span>|</span>
            <button type="button" class="btn mr-2 text-white" data-toggle="modal" data-target="#datenschutz-modal">Datenschutz</button>
        </span>
    </div>
</div>

@include('components.modals.agb')
@include('components.modals.datenschutz')
@include('components.modals.impressum')

<div class="modal fade" id="posting-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <a href="{{ route('profile.show', $posting->user->id) }}">
                        {{$posting->user->first_name ." ". $posting->user->last_name}}
                    </a>
                    @if($posting->location_type !== 0)
                        postete
                        <a href="{{$posting->getLocationRoute()}}">{{$posting->getLocationName()}}</a>
                        {{$posting->location_type == 1 ? " Profil" : ""}}
                    @else
                        postete
                    @endif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <span class="col-12">{{$posting->content}}</span>
                </div>

                <div class="row mt-5">
                    <div class="col-12">
                        @forelse($posting->comments as $comment)
                            <div class="row">
                                <span
                                    class="col-12">{{$posting->user->first_name ." " .$posting->user->last_name." am ".$posting->updated_at}}</span>
                            </div>
                            <div class="row mb-3">
                                <span class="col-12">{{$comment->content}}</span>
                            </div>
                        @empty
                            <div class="row">
                                <span class="col-12">Noch keine Kommentare sei der Erste.</span>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

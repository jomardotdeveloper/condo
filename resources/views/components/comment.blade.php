<div class="card">
    <div class="card-inner">
        <h4>Comments</h4>
        <div class="nk-msg-reply nk-reply" data-simplebar>
            @if (count($comments) <= 0)
                <p>No comments found.</p>
            @else
                @foreach ($comments as $comment)
                    <div class="nk-reply-item">
                        <div class="nk-reply-header">
                            <div class="user-card">
                                @if ($comment->user->user_type == 1)
                                <div class="user-avatar sm bg-blue">
                                    <span>{{ $comment->user->application->first_name[0] . $comment->user->application->last_name[0] }}</span>
                                </div>
                                @elseif($comment->user->user_type == 2)
                                <div class="user-avatar sm bg-blue">
                                    <span>{{ $comment->user->employee->first_name[0] . $comment->user->employee->last_name[0] }}</span>
                                </div>
                                @endif
                                
                                @if ($comment->user->user_type == 1)
                                <div class="user-name">{{ $comment->user->application->full_name }}</div>
                                @elseif($comment->user->user_type == 2)
                                <div class="user-name">{{ $comment->user->employee->full_name }}</div>
                                @endif
                                
                            </div>
                            <div class="date-time">{{ $comment->created_at }}</div>
                        </div>
                        <div class="nk-reply-body">
                            <div class="nk-reply-entry entry">
                                <p>
                                    {{ $comment->message }}
                                </p>
                            </div>
                            {{-- SOON --}}
                            {{-- <div class="attach-files">
                                <ul class="attach-list">
                                    <li class="attach-item">
                                        <a class="download" href="#"><em class="icon ni ni-img"></em><span>error-show-On-order.jpg</span></a>
                                    </li>
                                    <li class="attach-item">
                                        <a class="download" href="#"><em class="icon ni ni-img"></em><span>full-page-error.jpg</span></a>
                                    </li>
                                </ul>
                                <div class="attach-foot">
                                    <span class="attach-info">2 files attached</span>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    
                @endforeach
            
            @endif

            <form class="nk-reply-form" action="{{ route('comments.store') }}" method="POST">
                @csrf
                <div class="nk-reply-form-header">
                    <ul class="nav nav-tabs-s2 nav-tabs nav-tabs-sm">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#reply-form">Comment</a>
                        </li>
                    </ul>
                </div>
                <input type="hidden" name="model" value="{{ $model }}" />
                <input type="hidden" name="record" value="{{ $record }}" />
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" />
                <div class="tab-content">
                    <div class="tab-pane active" id="reply-form">
                        <div class="nk-reply-form-editor">
                            <div class="nk-reply-form-field">
                                <textarea class="form-control form-control-simple no-resize" name="message" placeholder="Hello"></textarea>
                            </div>
                            <div class="nk-reply-form-tools">
                                <ul class="nk-reply-form-actions g-1">
                                    <li class="me-2"><button class="btn btn-primary" type="submit">Reply</button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
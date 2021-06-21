@section('title','Send Mail')
<main style="margin-top:15vh;">

    <div>
        <div class="container" style="padding: 30px 0;">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6">
                                    Send Email
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                            @endif
                            <form class="form-horizontal" wire:submit.prevent="sendEmail">
                                @csrf
                                <div class="form-group">
                                    <label class="col-md-6 control-label">Subject</label>
                                    <div class="col-md-6">
                                        <input required type="text" name="subject" placeholder="Category Desc"
                                            class="form-control input-md" wire:model="subject">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 control-label">Email</label>
                                    <div class="col-md-12">
                                        <textarea required name="mail" 
                                            class="form-control input-md" wire:model="mail"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label"></label>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

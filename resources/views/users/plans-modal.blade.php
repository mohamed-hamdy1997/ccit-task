<div id="plansModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Subscribe To Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
{{--                <p>Plans.</p>--}}

                <div class="card-deck mb-3 text-center">
                    @foreach($plans as $plan)
                        <div class="card mb-4 box-shadow">
                            <div class="card-header">
                                <h4 class="my-0 font-weight-normal">{{ $plan->name }} ({{ $plan->type }})</h4>
                            </div>
                            <div class="card-body">
                                <h1 class="card-title pricing-card-title">SAR{{ $plan->price }} <small
                                        class="text-muted">/ {{ $plan->type_per_unit  }}</small></h1>
                                <button type="button" class="btn btn-lg btn-block btn-outline-primary">Subscribe
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

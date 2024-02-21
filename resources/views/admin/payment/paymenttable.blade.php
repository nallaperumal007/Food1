<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ trans('labels.name') }}</th>
            <th>{{ trans('labels.status') }}</th>
            <th>{{ trans('labels.action') }}</th>
        </tr>
    </thead>
    <tbody> 
        @php $n=0 @endphp
        @forelse($data as $row)      
        <tr id="del-{{$row->id}}">
            <td>{{++$n}}</td>
            <td>{{ $row->payment_name }}</td>
            <td id="tdstatus{{$row->id}}"> 
                @if (env('Environment') == 'sendbox')
                    @if($row->status == 1)
                        <a class="success p-0" onclick="myFunction()"><i class="ft-check font-medium-3 mr-2"></i></a>
                    @else
                        <a class="danger p-0" onclick="myFunction()"><i class="ft-x font-medium-3 mr-2"></i></a>
                    @endif
                @else
                    @if($row->status == 1)
                    <a class="success p-0" onclick="status('{{$row->id}}','2','{{ trans('messages.are_you_sure') }}','{{ trans('messages.yes') }}','{{ trans('messages.no') }}','@if (Auth::user()->type == 1) {{URL::to('admin/payments/edit/status')}} @endif @if (Auth::user()->type == 2) {{URL::to('vendor/payments/edit/status')}} @endif','{{ trans('messages.wrong') }}','{{ trans('messages.record_safe') }}')"><i class="ft-check font-medium-3 mr-2"></i></a>
                    @else
                    <a class="danger p-0" onclick="status('{{$row->id}}','1','{{ trans('messages.are_you_sure') }}','{{ trans('messages.yes') }}','{{ trans('messages.no') }}','@if (Auth::user()->type == 1) {{URL::to('admin/payments/edit/status')}} @endif @if (Auth::user()->type == 2) {{URL::to('vendor/payments/edit/status')}} @endif','{{ trans('messages.wrong') }}','{{ trans('messages.record_safe') }}')"><i class="ft-x font-medium-3 mr-2"></i></a>
                    @endif
                @endif
            </td>

            <td>
                @if($row->payment_name != 'COD')
                    <a href="@if (Auth::user()->type == 1) {{URL::to('admin/payments/edit-'.$row->id)}} @endif @if (Auth::user()->type == 2) {{URL::to('vendor/payments/edit-'.$row->id)}} @endif" class="success p-0" data-original-title="{{ trans('labels.view') }}" title="{{ trans('labels.view') }}">
                        <span class="badge badge-warning">View</span>
                    </a>
                @endif
            </td>
        </tr>
        @empty

        @endforelse
  </tbody>
</table>
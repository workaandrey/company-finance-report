@extends('layout')
@section('pageH1', 'PHP Exercise - v17.0.2')
@section('content')
    <form method="post" action="{{route('company.financesHistory')}}">
        {{csrf_field()}}
        <div class="form-group">
            <label for="companySymbol">Company Symbol</label>
            <input type="text" class="form-control" id="companySymbol" placeholder="Enter company symbol" name="companySymbol"
            required value="{{old('companySymbol')}}">
        </div>
        <div class="input-daterange">
            <div class="form-group">
                <label for="dateStart">Date Start</label>
                <div class="input-group date">
                    <input type="text" class="form-control" id="dateStart" name="dateStart"
                           placeholder="YYYY-MM-DD" required value="{{old('dateStart')}}">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="dateEnd">Date End</label>
                <div class="input-group date">
                    <input type="text" class="form-control" id="dateEnd" name="dateEnd"
                           placeholder="MM/DD/YYYY" required value="{{old('dateEnd')}}">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required
                   value="{{old('email')}}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
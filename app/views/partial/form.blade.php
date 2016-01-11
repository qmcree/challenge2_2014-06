<form method="post">
    <div class="form-group">
        <label for="date_start">Start Date</label>
        <input type="date" class="form-control" id="date_start" name="date_start"
               value="{{ (Input::has('date_start')) ? Input::get('date_start') : $today }}" required />
    </div>
    <div class="form-group">
        <label for="date_start">End Date</label>
        <input type="date" class="form-control" id="date_end" name="date_end"
               value="{{ (Input::has('date_end')) ? Input::get('date_end') : $today }}" required />
    </div>
    <div class="form-group">
        <label for="country">Country</label>
        <select class="form-control" id="country" name="country">
            <option value="" {{ (!Input::has('country')) ? 'selected' : '' }}>Select country...</option>
            @foreach ($countries as $country)
            <option value="{{ $country->country }}" {{ (Input::get('country') === $country->country) ? 'selected' : '' }}>{{{ $country->country }}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="offer">Offers</label>
        <select class="form-control" id="offer" name="offer_ids[]" multiple>
            <option value="0" {{ (!Input::has('offer_ids') || in_array('0', Input::get('offer_ids', []))) ? 'selected' : '' }}>All offers</option>
            @foreach ($offers as $offer)
            <option value="{{ $offer->id }}" {{ (in_array($offer->id, Input::get('offer_ids', []))) ? 'selected' : '' }}>{{{ $offer->name }}}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Generate</button>
    <button type="reset" class="btn btn-default">Reset</button>
</form>
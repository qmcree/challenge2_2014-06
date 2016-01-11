<?php

class ReportController extends BaseController
{
    const MSG_FAIL_DATE_RANGE = 'Start date cannot be after end date.';

    private $generated = false;

    /**
     * Renders form and results.
     *
     * @param \Offer | \Illuminate\Database\Eloquent\Collection $results
     * @return \Illuminate\View\View
     */
    public function showResults($results = null)
    {
        $offers = Offer::orderBy('name')->get();
        $countries = DB::table('offer_countries')->select('country')->distinct()->get();

        return $this->makeView('results', [
            'offers' => $offers,
            'today' => date('Y-m-d'),
            'countries' => $countries,
            'results' => $results,
            'generated' => $this->generated,
        ]);
    }

    /**
     * Generates results based on input.
     */
    public function generate()
    {
        $validation = $this->validate();

        if ($validation === true) {
            $offers = Offer::whereHas('leadstat', function($query) {
                $query->where('date', '>=', Input::get('date_start'))
                    ->where('date', '<=', Input::get('date_end'));
            });

            $country = Input::get('country');
            if (!empty($country)) {
                $offers->whereHas('countries', function($query) use ($country) {
                    $query->where('country', '=', $country);
                });
            }

            $offerIds = Input::get('offer_ids');
            // 0 denotes all offers.
            if (!in_array('0', $offerIds))
                $offers->whereRaw('id IN (' . implode(',', $offerIds) . ')');

            $this->generated = true;
            return $this->showResults($offers->get()->sortBy('name'));
        } else {
            $this->setAlertDanger($validation);
            return $this->showResults();
        }
    }

    /**
     * Validates user input.
     *
     * @return bool|string true if passed, HTML error messages if failed.
     */
    private function validate()
    {
        $validator = Validator::make([
            'date_start' => Input::get('date_start'),
            'date_end' => Input::get('date_end'),
            'country' => Input::get('country'),
            'offer_ids' => Input::get('offer_ids'),
        ], [
            'date_start' => ['required', 'date'],
            'date_end' => ['required', 'date'],
            'country' => ['alpha', 'max:2'],
            'offer_ids' => ['required', 'array'],
        ]);

        if ($validator->passes()) {
            if (strtotime(Input::get('date_start')) > strtotime(Input::get('date_end'))) {
                return self::MSG_FAIL_DATE_RANGE;
            } else {
                return true;
            }
        } else {
            return $this->renderMessages($validator->messages());
        }
    }
} 
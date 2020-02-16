<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class HelperFunctionsTest extends TestCase
{
    public function test_a_date_can_be_parsed_to_a_default_format_for_a_date_input()
    {
        $parsedDateForInput = parseDateForInput('14-02-2020 14:49');

        $this->assertEquals('2020-02-14T14:49', $parsedDateForInput);
    }

    public function test_a_date_can_be_parsed_with_given_format_for_date_input()
    {
        $parsedDateForInput = parseDateForInput('14-02-2020', 'Y-m-d');

        $this->assertEquals('2020-02-14', $parsedDateForInput);
    }

    public function test_the_parsed_date_for_date_input_field_of_now_is_given_with_a_default_format()
    {
        $dateOfNowForInput = dateNowForInput();

        $this->assertEquals(\Carbon\Carbon::now()->format('Y-m-d\TH:i'), $dateOfNowForInput);
    }

    public function test_the_parsed_date_for_date_input_field_of_now_is_given_with_a_given_format()
    {
        $dateOfNowForInput = dateNowForInput('Y-m-d');

        $this->assertEquals(\Carbon\Carbon::now()->format('Y-m-d'), $dateOfNowForInput);
    }

    public function test_check_if_id_matches_and_return_string()
    {
        $positiveResponse = checkIdForSelected(1, 1, 3, 4, 2);
        $negativeResponse = checkIdForSelected(1, 3, 4, 2);

        $this->assertEquals('selected', $positiveResponse);
        $this->assertEquals('', $negativeResponse);
    }
}

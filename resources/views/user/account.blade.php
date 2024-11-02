@extends('layouts.user')

@section('content')
    <div class="">
        <div class="text-center" style="width: 100%;">
            <h5 class="mb-0">Open an Account</h5>
            <p class="mx-auto text-muted mb-4 pb-4 fs-8" style="max-width: 800px;">It's easy to get started, whether you want to begin trading, investing, or are interested in savings and retirement accounts. Make selections below to help us find the right investing account(s) for you.</p>
        </div>
        <!-- <div class="card"> -->
            <div>
                <h5 class="text-center mb-4">Choose Account</h5>
            </div>

            <div class="mx-auto" style="max-width: 500px;">
                <h6 class="mb-4">Select Preference</h6>
                <div>
                    <div class="mb-3">
                        <label class="form-label" for="country">Who do you want to manage your investment?</label>
                        <select class="form-select @error('country') is-invalid @enderror" data-trigger name="country" id="management-type">
                            <option value="">Select answer</option>
                            <option value="self">I'll do it myself</option>
                            <option value="thirdparty">I want to use third party providers</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="country">What will you like to do?</label>
                        <select class="form-select @error('country') is-invalid @enderror" data-trigger name="country" id="investment-goal">
                            <option value="">Select answer</option>
                            <option value="self">Invest and Trade</option>
                            <option value="thirdparty_retirement">Save for Retirement</option>
                            <option value="thirdparty_kids">Save for Kids & Education</option>
                            <option value="thirdparty_medical">Save for Medical Expense</option>
                            <option value="thirdparty_selfemployed">Self Employed</option>
                            <option value="thirdparty_all">Everything</option>
                        </select>
                    </div>
                </div>

                <h6 class="mb-4 mt-4 pt-3">Account Result</h6>
            </div>

            <div class="mx-auto" style="">
                <div class="row d-flex flex-wrap">
                    <div class="col-lg-3 col-md-4 col-sm-12 my-2" id="brokerage">
                        <div class="card p-3 h-100 d-flex flex-column">
                            <div class="">
                                <p class="text-primary" style="margin-bottom: 5px;">Itrust Brokerage Account </p>
                                <span class="badge rounded bg-success float-end" style="margin-top: -23px;">Recommended</span>
                            </div>
                            <h4 class=" fs-8">Invest on your own</h4>
                            <p>
                                This multi-feature trading and investing account allows you to select from a broad 
                                range of investment choices, including stocks, 
                                crypto, bonds, ETFs, options, and mutual funds.
                            </p>
                            <ul>
                                <li>No account minimum</li>
                                <li>No fees</li>
                                <li>An option for someone who wants to trade any amount—invest with as little as $1</li>
                            </ul>

                            <button class="btn btn-primary px-3 py-2 rounded-pile"> Create Account </button>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12 my-2" id="management">
                        <div class="card p-3 h-100 d-flex flex-column">
                            <div class="">
                                <p class="text-primary" style="margin-bottom: 10px;">Cash Management Account</p>
                            </div>
                            <h4 class=" fs-8">Go beyond banking</h4>
                            <p>
                                This account offers you all the features of a traditional checking account but with even more 
                                competitive rates on your cash.
                            </p>
                            <ul>
                                <li>No account fees or minimums</li>
                                <li>Global reimbursement on card withdrawals</li>
                                <li>Free debit card, check writing, and Bill Pay, plus an FDIC-insured option on cash balances</li>
                            </ul>

                            <button class="btn btn-primary px-3 py-2 rounded-pile"> Create Account </button>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12 my-2" id="ira">
                        <div class="card p-3 h-100 d-flex flex-column">
                            <div class="">
                                <p class="text-primary" style="margin-bottom: 10px;"> ROTH IRA </p>
                            </div>
                            <h4 class=" fs-8">Potential tax-free growth and withdrawals*</h4>
                            <p>
                                Save for retirement with after-tax dollars and withdraw the money tax-free in retirement.
                            </p>
                            <ul>
                                <li>No account fees or minimums to open an account</li>
                                <li>Potential earnings grow tax-free</li>
                                <li>An option if you want flexibility to withdraw contributions at any time for any reason, tax-free and penalty-free</li>
                            </ul>

                            <button class="btn btn-primary px-3 py-2 rounded-pile"> Create Account </button>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12 my-2" id="rollover">
                        <div class="card p-3 h-100 d-flex flex-column">
                            <div class="">
                                <p class="text-primary" style="margin-bottom: 10px;">ROLLOVER IRA</p>
                            </div>
                            <h4 class=" fs-8">Simplify your retirement savings with your accounts in one place</h4>
                            <p>
                                Consolidate your old 401(k) and workplace accounts into a centralized account without taxes
                                or penalties.
                            </p>
                            <ul>
                                <li>No account fees or minimums to open an account</li>
                                <li>Continue to save with a wide range of investment options</li>
                                <li>An option for someone who is changing or leaving a job or getting ready to retire.</li>
                            </ul>

                            <button class="btn btn-primary px-3 py-2 rounded-pile"> Create Account </button>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12 my-2" id="traditional">
                        <div class="card p-3 h-100 d-flex flex-column">
                            <div class="">
                                <p class="text-primary" style="margin-bottom: 10px;">Traditional IRA</p>
                            </div>
                            <h4 class=" fs-8">Tax-deferred investing for your retirement</h4>
                            <p>
                                Save for retirement and reduce your taxable income, if eligible, and your potential earnings could grow tax-deferred.
                            </p>
                            <ul>
                                <li>No account fees or minimums to open an account</li>
                                <li>Penalty-free withdrawals for certain expenses</li>
                                <li>An option if you want to take advantage of tax savings now</li>
                            </ul>

                            <button class="btn btn-primary px-3 py-2 rounded-pile"> Create Account </button>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12 my-2" id="sep">
                        <div class="card p-3 h-100 d-flex flex-column">
                            <div class="">
                                <p class="text-primary" style="margin-bottom: 10px;">SEP IRA</p>
                            </div>
                            <h4 class=" fs-8">Retirement savings for the self-employed</h4>
                            <p>
                                This account helps self-employed individuals and small-business owners get access to a tax-deferred benefit when saving for retirement.
                            </p>
                            <ul>
                                <li>No account minimum</li>
                                <li>No account fees</li>
                                <li>An option for someone who wants tax-deferred growth and flexible investment options</li>
                            </ul>

                            <button class="btn btn-primary px-3 py-2 rounded-pile"> Create Account </button>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12 my-2" id="employed">
                        <div class="card p-3 h-100 d-flex flex-column">
                            <div class="">
                                <p class="text-primary" style="margin-bottom: 10px;">Self employed 401(k)</p>
                            </div>
                            <h4 class=" fs-8">A retirement account for business owners</h4>
                            <p>
                                An account that caters to the needs of self-employed and owner-only businesses.
                            </p>
                            <ul>
                                <li>No investment minimum</li>
                                <li>No account fees</li>
                                <li>An option for someone who wants tax-deferred growth and flexible investment options</li>
                            </ul>

                            <button class="btn btn-primary px-3 py-2 rounded-pile"> Create Account </button>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12 my-2" id="hsa">
                        <div class="card p-3 h-100 d-flex flex-column">
                            <div class="">
                                <p class="text-primary" style="margin-bottom: 10px;">HSA</p>
                            </div>
                            <h4 class=" fs-8">Invest your health savings</h4>
                            <p>
                                Investing your health savings account (HSA) for potential tax-free growth can help you save
                                for qualified medical expenses.
                            </p>
                            <ul>
                                <li>No investment minimum</li>
                                <li>No fees, depending on investments</li>
                                <li>An option for short- and long-term growth</li>
                            </ul>

                            <button class="btn btn-primary px-3 py-2 rounded-pile"> Create Account </button>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12 my-2" id="custodial">
                        <div class="card p-3 h-100 d-flex flex-column">
                            <div class="">
                                <p class="text-primary" style="margin-bottom: 10px;">Custodial Account</p>
                            </div>
                            <h4 class=" fs-8">Invest for a child’s future</h4>
                            <p>
                                This account is a way to save or give a financial gift to a child. 
                                Funds can be invested in a range of options—all to give a child a better future.
                            </p>
                            <ul>
                                <li>No accounts fee or minimums to open an account</li>
                                <li>No contribution limits or withdrawal penalties</li>
                                <li>An option for someone who wants to invest for a child while retaining control of the account until they reach adulthood</li>
                            </ul>

                            <button class="btn btn-primary px-3 py-2 rounded-pile"> Create Account </button>
                        </div>
                    </div>
                </div>
            </div>
        <!-- </div>  -->
    </div>
@endsection

@section('script')

<script>
$(document).ready(function() { 
    var navbar = $('.topnav');
    navbar.hide()
})
</script>

<script>
    $(document).ready(function () {
        // Get references to the dropdown and all cards
        const $investmentGoal = $('#investment-goal');

        // Function to hide all cards
        const hideAllCards = () => {
            $('.row .col-lg-3').hide(); // Hide all cards
        };

        // Function to show selected cards based on the goal
        const showSelectedCards = (cardsToShow) => {
            cardsToShow.forEach(cardId => {
                $('#' + cardId).show(); // Show specific cards
            });
        };

        // Listen for changes on the dropdown
        $investmentGoal.on('change', function () {
            hideAllCards(); // Hide all cards initially

            // Get the selected goal value
            const selectedGoal = $investmentGoal.val();

            // Define the mapping of goals to cards
            const goalCards = {
                'self': ['brokerage', 'management'], // Invest and Trade
                'thirdparty_retirement': ['ira', 'traditional', 'rollover', 'sep'], // Save for Retirement
                'thirdparty_kids': ['management', 'custodial'], // Save for Kids & Education
                'thirdparty_medical': ['hsa'], // Save for Medical Expenses
                'thirdparty_selfemployed': ['sep', 'employed'], // Self Employed
                'thirdparty_all': ['brokerage', 'ira', 'traditional', 'rollover', 'management', 'hsa', 'custodial', 'sep', 'employed'], // Everything
            };

            // If a valid goal is selected, show the corresponding cards
            if (goalCards[selectedGoal]) {
                showSelectedCards(goalCards[selectedGoal]);
            } else {
                $('.row .col-lg-3').show(); // Show all cards by default if no valid goal is selected
            }
        });

        // Initially show all cards when the page loads
        $('.row .col-lg-3').show();
    });
</script>



@endsection

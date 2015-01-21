<style>
    #faq {
        margin-bottom: 150px;
    }
    #faq .section_header {
        margin-top: 55px;
    }
    #faq .faq {
        margin-bottom: 30px;
        padding-left: 50px;
        position: relative;
    }
    #faq .faq:hover .plus {
        background-color: #ff675b;
        color: #fff;
    }
    #faq .faq:hover .question {
        color: #ff675b;
    }
    #faq .faq .plus {
        background-color: #ffffff;
        border: 1px solid #ededed;
        color: #333;
        left: 0;
        padding: 5px 10px;
        position: absolute;
        top: -5px;
        transition: background-color 0.3s linear 0s;
    }
    #faq .faq .question {
        color: #333;
        cursor: pointer;
        font-size: 14px;
        transition: color 0.2s linear 0s;
    }
    #faq .faq .answer {
        color: #333333 !important;
        display: none;
        margin-top: 30px;
        padding-bottom: 15px;
    }
    #faq .faq hr {
        -moz-border-bottom-colors: none;
        -moz-border-left-colors: none;
        -moz-border-right-colors: none;
        -moz-border-top-colors: none;
        border-color: #eeeeee -moz-use-text-color #ffffff;
        border-image: none;
        border-style: solid none;
        border-width: 1px 0;
        margin: 20px 0;
    }
    #faq .faq .answer p{
        font-size: 13px;
        font-weight: normal;
    }
</style>

<div style="padding: 50px; min-height: 400px; background-color: #f7f7f7" class="container ng-scope">
    <div>
        <h3>Frequently Asked Questions</h3><br>
        <div class="row">
            <div class="faq_page" id="faq">
                <div class="category-header"><h5>Our Gaurantee</h5><p class="category-description"></p></div>    <div class="faq">
                    <div class="plus">+</div>
                    <div class="question">
                        What if my suit does not fit?      </div>
                    <div class="answer" style="display: none;">
                        <p>We strive to make every suit fit right out of the box. However, if it does not, the Aether Promise covers alteration fees of up to $75.</p>
                        <hr>
                    </div>
                </div>
                <div class="category-header"><h5>General Questions</h5><p class="category-description"></p></div>    <div class="faq">
                    <div class="plus">+</div>
                    <div class="question">
                        Where are the suits made?      </div>
                    <div class="answer">
                        <p>Our company is based out of Colorado, USA. However, all suits are handmade from scratch in Thailand by tailors with over 10 years experience.</p>
                        <hr>
                    </div>
                </div>
                <div class="faq">
                    <div class="plus">+</div>
                    <div class="question">
                        How long does the process take?      </div>
                    <div class="answer" style="display: none;">
                        <p>From start to finish, you can create your suit and input your measurements between 30 minutes to an hour; less time than going to your department store and choosing something off the rack.</p>
                        <hr>
                    </div>
                </div>
                <div class="faq">
                    <div class="plus">+</div>
                    <div class="question">
                        My fashion sense is less than zero, yet I want a suit that will impress. What should I do?      </div>
                    <div class="answer">
                        <p>In terms of fabric, stick with timeless classics, your blacks, greys and dark blues. Our Suits 101 guide will help you choose the right style for your body type.</p>
                        <hr>
                    </div>
                </div>
                <div class="category-header"><h5>Pre-Sales Questions</h5><p class="category-description"></p></div>    <div class="faq">
                    <div class="plus">+</div>
                    <div class="question">
                        It is my first time buying a suit. Where should I start?      </div>
                    <div class="answer">
                        <p>Head over to the Suits 101 page to get a basic understanding of suits and check out the 101 guide to find a style right for you.</p>
                        <hr>
                    </div>
                </div>
                <div class="faq">
                    <div class="plus">+</div>
                    <div class="question">
                        I do not have the ‘average’ body type, is an Aether Suit still right for me?      </div>
                    <div class="answer" style="display: none;">
                        <p>By all accounts a bespoke suit is even more right for you. Because the box stores will not carry your size, Aether starts from scratch to make a suit that will fit YOU.</p>
                        <hr>
                    </div>
                </div>
                <div class="faq">
                    <div class="plus">+</div>
                    <div class="question">
                        Do I need a tailor to measure myself?      </div>
                    <div class="answer">
                        <p>No. Our measurement guide is designed so that you may measure yourself with a tailors tape and the help of a friend. The whole process take 15 minutes and saves you a tailors fee (usually around $15).</p>
                        <hr>
                    </div>
                </div>
                <div class="category-header"><h5>Shipping</h5><p class="category-description"></p></div>    <div class="faq">
                    <div class="plus">+</div>
                    <div class="question">
                        How much is shipping?      </div>
                    <div class="answer">
                        <p>Zero, nada, nothing, zip. Shipping on all orders is FREE. </p>
                        <hr>
                    </div>
                </div>
                <div class="faq">
                    <div class="plus">+</div>
                    <div class="question">
                        Do I need to pay customs to receive my suit?      </div>
                    <div class="answer">
                        <p>No. Our shipping solution takes care of all tariffs and customs.</p>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".faq").click(function(){
       $(this).find(".answer").toggle();
    });
</script>
@extends('layouts.app')

@section('content')
<div class="col2 fl-r">
    <button class="btn bgc-orange w100per">CREATE</button>
</div>
<div class="tabs">
    <input id="a" type="radio" name="tab_item">
    <label class="tab_item" for="a">企業側</label>
    <input id="b" type="radio" name="tab_item">
    <label class="tab_item" for="b">産業医側</label>
    <!--01-->
    <div class="tab_content" id="a_content">
        <div class="tab_content_description">
            <section>
                <table class="spTable sindu_origin_table" id="table">
                    <tbody>
                        <tr>
                            <th class="default sindu_handle">投稿日</th>
                            <th class="default sindu_handle">タイトル</th>
                        </tr>
                        <tr>
                            <td class="w20per">AAAAAAAAAAAAAA</td>
                            <td>BBBB</td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </div>
    </div>
    <!--02-->
    <div class="tab_content" id="b_content">
        <div class="tab_content_description">
            <section>
                <table class="spTable sindu_origin_table" id="table">
                    <tbody>
                        <tr>
                            <th class="default sindu_handle">投稿日</th>
                            <th class="default sindu_handle">タイトル</th>
                        </tr>
                        <tr>
                            <td class="w20per">CCCC</td>
                            <td>DDDD </td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </div>
    </div>
    <br>

</div>
<!--tabs-->

@endsection

@section('js')

@endsection


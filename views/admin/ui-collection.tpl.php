<div class="row">
    <h1>Buttons</h1>
    <div class="col-sm-6">
        <button class="btn btn-default">Default</button>
        <button class="btn btn-primary">Primary</button>
        <button class="btn btn-primary2">Primary2</button>
        <button class="btn btn-success">Success</button>
        <button class="btn btn-warning">Warning</button>
        <button class="btn btn-danger">Danger</button>
    </div>
</div>

<div class="row">
    <h1>Panels</h1>
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">Panel Default</div>
            <div class="panel-body">
                <h3 class="underlined">Underlined title</h3>
                <p>Panels are the very base of our material design ui-kit. You can use them with or without .panel-heading and .panel-footer divs. Primary, Primary2, Success, warning, and Danger classes are availables.</p>
                <div class="text-right">
                    <button class="btn btn-default">Button</button>
                </div>
            </div>
            <div class="panel-footer text-center">Footer</div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-primary">
            <div class="panel-heading">Panel Primary</div>
            <div class="panel-body">
                <p>Panels are the very base of our material design ui-kit. You can use them with or without .panel-heading and .panel-footer divs. Primary, Primary2, Success, warning, and Danger classes are availables.</p>
                <div class="text-right">
                    <button class="btn btn-primary">Button</button>
                </div>
            </div>
            <div class="panel-footer text-center">Footer</div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-primary2">
            <div class="panel-heading">Panel Primary2</div>
            <div class="panel-body">
                <p>Panels are the very base of our material design ui-kit. You can use them with or without .panel-heading and .panel-footer divs. Primary, Primary2, Success, warning, and Danger classes are availables.</p>
                <div class="text-right">
                    <button class="btn btn-primary2">Button</button>
                </div>
            </div>
            <div class="panel-footer text-center">Footer</div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-success">
            <div class="panel-heading">Panel Success</div>
            <div class="panel-body">
                <p>Panels are the very base of our material design ui-kit. You can use them with or without .panel-heading and .panel-footer divs. Primary, Primary2, Success, warning, and Danger classes are availables.</p>
                <div class="text-right">
                    <button class="btn btn-success">Button</button>
                </div>
            </div>
            <div class="panel-footer text-center">Footer</div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-warning">
            <div class="panel-heading">Panel Warning</div>
            <div class="panel-body">
                <p>Panels are the very base of our material design ui-kit. You can use them with or without .panel-heading and .panel-footer divs. Primary, Primary2, Success, warning, and Danger classes are availables.</p>
                <div class="text-right">
                    <button class="btn btn-warning">Button</button>
                </div>
            </div>
            <div class="panel-footer text-center">Footer</div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-danger">
            <div class="panel-heading">Panel Danger</div>
            <div class="panel-body">
                <p>Panels are the very base of our material design ui-kit. You can use them with or without .panel-heading and .panel-footer divs. Primary, Primary2, Success, warning, and Danger classes are availables.</p>
                <div class="text-right">
                    <button class="btn btn-danger">Button</button>
                </div>
            </div>
            <div class="panel-footer text-center">Footer</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <h1>Forms</h1>
        <div class="panel">
            <div class="panel-body">
                <form>
                    <div class="input-grp">
                        <label for="text-input" class="control-label">Label : </label>
                        <input class="form-control" type="text" name="text-input" placeholder="text input">
                    </div>
                    <div class="input-grp">
                        <select class="form-control">
                            <option>Select one</option>
                            <option>Or another</option>
                        </select>
                    </div>
                    <div class="input-grp">
                        <label for="radio1">Radio 1</label>
                        <input type="radio" name="radio" id="radio1">
                        <label for="radio2">Radio 2</label>
                        <input type="radio" name="radio" id="radio2">
                    </div>
                    <div class="input-grp">
                        <label for="check1">Checbox 1</label>
                        <input type="checkbox" name="check" id="check1">
                        <label for="check2">Checbox 2</label>
                        <input type="checkbox" name="check" id="check2">
                    </div>
                    <div class="input-grp">
                        <textarea class="form-control" rows="10" placeholder="text area"></textarea>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <h1>Ajax form</h1>
        <div class="panel">
            <div class="panel-body">
                <form class="ajax-form" action="user" method="POST" >
                    <div class="input-grp">
                        <label for="text-ajax" class="control-label">
                            Some text
                        </label>
                        <input class="form-control" type="text" name="text-ajax" placeholder="test">
                    </div>
                    <div class="input-grp">
                        <select class="form-control">
                            <option></option>
                            <option value="one">Select one</option>
                            <option value="another">Or another</option>
                        </select>
                    </div>
                    <div class="input-grp">
                        <label for="radio1">Radio 1</label>
                        <input type="radio" name="radio" id="radio1" value="1">
                        <label for="radio2">Radio 2</label>
                        <input type="radio" name="radio" id="radio2" value="2">
                    </div>
                    <div class="input-grp">
                        <label for="check1">Checbox 1</label>
                        <input type="checkbox" name="check" id="check1" value="1">
                        <label for="check2">Checbox 2</label>
                        <input type="checkbox" name="check" id="check2" value="2">
                    </div>
                    <div class="text-right">
                        <button class="btn btn-primary" type="submit">
                            OK
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <h1>Icons</h1>
        <div class="panel panel-default">
            <div class="panel-body">
                We use Fontawesome, you can find the collection <a href="https://fortawesome.github.io/Font-Awesome/icons/" target="_blank">here</a> <span class="fa fa-hand-peace-o"></span>.
            </div>
        </div>
    </div>
</div>

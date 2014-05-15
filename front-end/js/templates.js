
Ember.TEMPLATES['account'] = Ember.Handlebars.template(function anonymous(Handlebars,depth0,helpers,partials,data) {
this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Ember.Handlebars.helpers); data = data || {};
  var buffer = '', stack1, stack2, hashContexts, hashTypes, options, helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression, self=this;

function program1(depth0,data) {
  
  var buffer = '', stack1, hashContexts, hashTypes, options;
  data.buffer.push("\n				");
  hashContexts = {'type': depth0,'value': depth0,'placeholder': depth0,'key-up': depth0,'focus-out': depth0};
  hashTypes = {'type': "STRING",'value': "ID",'placeholder': "STRING",'key-up': "ID",'focus-out': "STRING"};
  options = {hash:{
    'type': ("text"),
    'value': ("accountPassword"),
    'placeholder': ("Password"),
    'key-up': ("validatePassword"),
    'focus-out': ("editPassword")
  },contexts:[],types:[],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  data.buffer.push(escapeExpression(((stack1 = helpers.input || depth0.input),stack1 ? stack1.call(depth0, options) : helperMissing.call(depth0, "input", options))));
  data.buffer.push("\n			");
  return buffer;
  }

function program3(depth0,data) {
  
  var buffer = '', stack1, hashContexts, hashTypes;
  data.buffer.push("\n				<label ");
  hashContexts = {'click': depth0};
  hashTypes = {'click': "ID"};
  data.buffer.push(escapeExpression(helpers.action.call(depth0, "editPassword", {hash:{
    'click': ("editPassword")
  },contexts:[depth0],types:["STRING"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push(">\n					");
  hashTypes = {};
  hashContexts = {};
  stack1 = helpers['if'].call(depth0, "accountPassword", {hash:{},inverse:self.program(6, program6, data),fn:self.program(4, program4, data),contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data});
  if(stack1 || stack1 === 0) { data.buffer.push(stack1); }
  data.buffer.push("\n				</label>\n			");
  return buffer;
  }
function program4(depth0,data) {
  
  
  data.buffer.push("\n						Click save to update account details\n					");
  }

function program6(depth0,data) {
  
  
  data.buffer.push("\n						Click to edit password\n					");
  }

function program8(depth0,data) {
  
  var buffer = '', stack1, hashTypes, hashContexts;
  data.buffer.push("\n					");
  hashTypes = {};
  hashContexts = {};
  stack1 = helpers['if'].call(depth0, "isPasswordValid", {hash:{},inverse:self.noop,fn:self.program(9, program9, data),contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data});
  if(stack1 || stack1 === 0) { data.buffer.push(stack1); }
  data.buffer.push("\n				");
  return buffer;
  }
function program9(depth0,data) {
  
  var buffer = '', hashTypes, hashContexts;
  data.buffer.push("\n						<button class=\"btn btn-lg btn-primary center\"");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers.action.call(depth0, "performUpdate", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push(">Save</button>\n					");
  return buffer;
  }

  data.buffer.push("<div class=\"progress progress-striped browse-item-rating-progress topbar\" id=\"browse-show-rating-progress\">\n  \n  <div class=\"progress-bar progress-bar-danger\" style=\"width: 100%\">\n    <div id=\"browse-show-rating\">Account</div>\n  </div>\n\n</div>\n\n<div class=\"container\">\n<div class=\"row\">\n	<div class=\"col-lg-8\">\n		<ul class=\"account-list\">\n			<li>\n\n				");
  hashContexts = {'type': depth0,'disabled': depth0,'placeholder': depth0};
  hashTypes = {'type': "STRING",'disabled': "STRING",'placeholder': "ID"};
  options = {hash:{
    'type': ("text"),
    'disabled': ("true"),
    'placeholder': ("session.account.email")
  },contexts:[],types:[],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  data.buffer.push(escapeExpression(((stack1 = helpers.input || depth0.input),stack1 ? stack1.call(depth0, options) : helperMissing.call(depth0, "input", options))));
  data.buffer.push("\n			</li>\n			<li>\n			");
  hashTypes = {};
  hashContexts = {};
  stack2 = helpers['if'].call(depth0, "isEditingPassword", {hash:{},inverse:self.program(3, program3, data),fn:self.program(1, program1, data),contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data});
  if(stack2 || stack2 === 0) { data.buffer.push(stack2); }
  data.buffer.push("\n			</li>\n			<li>\n				");
  hashTypes = {};
  hashContexts = {};
  stack2 = helpers['if'].call(depth0, "accountPassword", {hash:{},inverse:self.noop,fn:self.program(8, program8, data),contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data});
  if(stack2 || stack2 === 0) { data.buffer.push(stack2); }
  data.buffer.push("\n			</li>\n			<li>\n				<div class=\"alert alert-info col-lg-8\" style=\"display:none;margin:auto auto;\" id=\"passwordwarning\"> \n  					<b>Alright, so ...</b> 8 or more characters. At least a number, an uppercase letter and a lowercase letter. Deal?\n  				</div>\n			</li>\n		</ul>\n	</div>\n</div>\n</div>\n");
  return buffer;
  
});

Ember.TEMPLATES['application'] = Ember.Handlebars.template(function anonymous(Handlebars,depth0,helpers,partials,data) {
this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Ember.Handlebars.helpers); data = data || {};
  var buffer = '', stack1, hashTypes, hashContexts, options, helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;


  data.buffer.push("<div id=\"wrapper\">\n");
  hashTypes = {};
  hashContexts = {};
  options = {hash:{},contexts:[depth0],types:["STRING"],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  data.buffer.push(escapeExpression(((stack1 = helpers.outlet || depth0.outlet),stack1 ? stack1.call(depth0, "navigation", options) : helperMissing.call(depth0, "outlet", "navigation", options))));
  data.buffer.push("\n");
  hashTypes = {};
  hashContexts = {};
  options = {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  data.buffer.push(escapeExpression(((stack1 = helpers.outlet || depth0.outlet),stack1 ? stack1.call(depth0, "modal", options) : helperMissing.call(depth0, "outlet", "modal", options))));
  data.buffer.push("\n<div id=\"page-content\">\n");
  hashContexts = {'name': depth0};
  hashTypes = {'name': "STRING"};
  options = {hash:{
    'name': ("main")
  },contexts:[],types:[],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  data.buffer.push(escapeExpression(((stack1 = helpers['animated-outlet'] || depth0['animated-outlet']),stack1 ? stack1.call(depth0, options) : helperMissing.call(depth0, "animated-outlet", options))));
  data.buffer.push("\n</div>\n\n");
  hashTypes = {};
  hashContexts = {};
  options = {hash:{},contexts:[depth0],types:["STRING"],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  data.buffer.push(escapeExpression(((stack1 = helpers.partial || depth0.partial),stack1 ? stack1.call(depth0, "footer", options) : helperMissing.call(depth0, "partial", "footer", options))));
  data.buffer.push("\n\n</div>\n\n ");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "debugger", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\n ");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers.log.call(depth0, "record", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\n");
  return buffer;
  
});

Ember.TEMPLATES['calendar'] = Ember.Handlebars.template(function anonymous(Handlebars,depth0,helpers,partials,data) {
this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Ember.Handlebars.helpers); data = data || {};
  var buffer = '', stack1, hashTypes, hashContexts, escapeExpression=this.escapeExpression, self=this, helperMissing=helpers.helperMissing;

function program1(depth0,data) {
  
  var buffer = '', hashTypes, hashContexts;
  data.buffer.push("\n   	 	<button class=\"calendar-topbar-icon prev-button\"><div data-icon=\"&#xe059;\" class=\"icon\" ");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers.action.call(depth0, "previousMonth", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("></div></button>\n   	 ");
  return buffer;
  }

function program3(depth0,data) {
  
  var buffer = '', stack1, hashTypes, hashContexts;
  data.buffer.push("\n		<div class=\"col-lg-1 calendar-month-day\">\n			");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "day.dayNumber", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\n\n			");
  hashTypes = {};
  hashContexts = {};
  stack1 = helpers.each.call(depth0, "show", "in", "episodesByDay", {hash:{},inverse:self.noop,fn:self.program(4, program4, data),contexts:[depth0,depth0,depth0],types:["ID","ID","ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data});
  if(stack1 || stack1 === 0) { data.buffer.push(stack1); }
  data.buffer.push("\n		</div>\n	");
  return buffer;
  }
function program4(depth0,data) {
  
  var buffer = '', stack1, stack2, hashContexts, hashTypes, options;
  data.buffer.push("\n				<div class=\"row\">\n					<div class=\"col-lg-12 calendar-airdate\">\n						");
  hashContexts = {'animations': depth0};
  hashTypes = {'animations': "STRING"};
  options = {hash:{
    'animations': ("main:fade")
  },inverse:self.noop,fn:self.program(5, program5, data),contexts:[depth0,depth0],types:["STRING","ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  stack2 = ((stack1 = helpers['link-to-animated'] || depth0['link-to-animated']),stack1 ? stack1.call(depth0, "show", "show.id", options) : helperMissing.call(depth0, "link-to-animated", "show", "show.id", options));
  if(stack2 || stack2 === 0) { data.buffer.push(stack2); }
  data.buffer.push("\n					</div>\n				</div>\n			");
  return buffer;
  }
function program5(depth0,data) {
  
  var buffer = '', hashTypes, hashContexts;
  data.buffer.push("\n							");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "show.name", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\n						");
  return buffer;
  }

function program7(depth0,data) {
  
  var buffer = '', hashTypes, hashContexts;
  data.buffer.push("\n	<tr>\n		<td>");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "episode.show.name", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("</td>\n		<td>");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "episode.season", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("</td>\n		<td>");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "episode.episodeNum", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("</td>\n		<td>");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "episode.summary", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("</td>\n		<td>");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "episode.date", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("</td>\n	</tr>\n");
  return buffer;
  }

  data.buffer.push("<div class=\"progress progress-striped browse-item-rating-progress topbar\" id=\"browse-show-rating-progress\">\n  \n  <div class=\"progress-bar progress-bar-warning\" style=\"width: 100%\">\n   	 <div id=\"browse-show-rating\">\n   	 ");
  hashTypes = {};
  hashContexts = {};
  stack1 = helpers['if'].call(depth0, "allowPrevious", {hash:{},inverse:self.noop,fn:self.program(1, program1, data),contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data});
  if(stack1 || stack1 === 0) { data.buffer.push(stack1); }
  data.buffer.push("\n   	 	");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "monthName", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\n   	 	<button class=\"calendar-topbar-icon next-button\"><div data-icon=\"&#xe061;\" class=\"icon\" ");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers.action.call(depth0, "nextMonth", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("></div></button>\n   	 </div>\n  </div>\n\n</div>\n\n<div class=\"container\">\n<div class=\"row\">\n	");
  hashTypes = {};
  hashContexts = {};
  stack1 = helpers.each.call(depth0, "day", "in", "daysInMonth", {hash:{},inverse:self.noop,fn:self.program(3, program3, data),contexts:[depth0,depth0,depth0],types:["ID","ID","ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data});
  if(stack1 || stack1 === 0) { data.buffer.push(stack1); }
  data.buffer.push("\n</div>\n\n<h2>Upcoming episodes</h2>\n<div class=\"row\">\n\n<table class=\"table table-responsive\">\n	<thead>\n		<th>Show</th>\n		<th>Season</th>\n		<th>Episode</th>\n		<th>Synopsis</th>\n		<th>Date</th>\n	</thead>\n	<tbody>\n");
  hashTypes = {};
  hashContexts = {};
  stack1 = helpers.each.call(depth0, "episode", "in", "controller", {hash:{},inverse:self.noop,fn:self.program(7, program7, data),contexts:[depth0,depth0,depth0],types:["ID","ID","ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data});
  if(stack1 || stack1 === 0) { data.buffer.push(stack1); }
  data.buffer.push("\n	</tbody>\n</table>\n</div>\n</div>");
  return buffer;
  
});

Ember.TEMPLATES['channel'] = Ember.Handlebars.template(function anonymous(Handlebars,depth0,helpers,partials,data) {
this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Ember.Handlebars.helpers); data = data || {};
  var buffer = '', stack1, stack2, hashTypes, hashContexts, options, escapeExpression=this.escapeExpression, self=this, helperMissing=helpers.helperMissing;

function program1(depth0,data) {
  
  
  data.buffer.push("←All Channels");
  }

function program3(depth0,data) {
  
  
  data.buffer.push("Edit");
  }

  data.buffer.push("<h2>Channel</h2>\n\n<p>\n  <b>Country id:</b> ");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "country_id", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\n</p>\n\n<p>\n  <b>Name:</b> ");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "name", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\n</p>\n\n");
  hashTypes = {};
  hashContexts = {};
  options = {hash:{},inverse:self.noop,fn:self.program(1, program1, data),contexts:[depth0],types:["STRING"],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  stack2 = ((stack1 = helpers.linkTo || depth0.linkTo),stack1 ? stack1.call(depth0, "channels", options) : helperMissing.call(depth0, "linkTo", "channels", options));
  if(stack2 || stack2 === 0) { data.buffer.push(stack2); }
  data.buffer.push("\n");
  hashTypes = {};
  hashContexts = {};
  options = {hash:{},inverse:self.noop,fn:self.program(3, program3, data),contexts:[depth0,depth0],types:["STRING","ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  stack2 = ((stack1 = helpers.linkTo || depth0.linkTo),stack1 ? stack1.call(depth0, "edit_channel", "model", options) : helperMissing.call(depth0, "linkTo", "edit_channel", "model", options));
  if(stack2 || stack2 === 0) { data.buffer.push(stack2); }
  data.buffer.push("\n<a href=\"#\" ");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers.action.call(depth0, "destroy", {hash:{},contexts:[depth0],types:["STRING"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push(">Destroy</a>\n");
  return buffer;
  
});

Ember.TEMPLATES['channels'] = Ember.Handlebars.template(function anonymous(Handlebars,depth0,helpers,partials,data) {
this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Ember.Handlebars.helpers); data = data || {};
  var buffer = '', stack1, stack2, hashTypes, hashContexts, options, escapeExpression=this.escapeExpression, self=this, helperMissing=helpers.helperMissing;

function program1(depth0,data) {
  
  
  data.buffer.push("New Channel");
  }

function program3(depth0,data) {
  
  var buffer = '', stack1, stack2, hashTypes, hashContexts, options;
  data.buffer.push("\n    <tr>\n      <td>");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "channel.country_id", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("</td>\n      <td>");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "channel.name", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("</td>\n      <td>");
  hashTypes = {};
  hashContexts = {};
  options = {hash:{},inverse:self.noop,fn:self.program(4, program4, data),contexts:[depth0,depth0],types:["STRING","ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  stack2 = ((stack1 = helpers.linkTo || depth0.linkTo),stack1 ? stack1.call(depth0, "channel", "channel", options) : helperMissing.call(depth0, "linkTo", "channel", "channel", options));
  if(stack2 || stack2 === 0) { data.buffer.push(stack2); }
  data.buffer.push("</td>\n    </tr>\n    ");
  return buffer;
  }
function program4(depth0,data) {
  
  
  data.buffer.push("view");
  }

  data.buffer.push("<h2>Channels</h2>\n\n");
  hashTypes = {};
  hashContexts = {};
  options = {hash:{},inverse:self.noop,fn:self.program(1, program1, data),contexts:[depth0],types:["STRING"],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  stack2 = ((stack1 = helpers.linkTo || depth0.linkTo),stack1 ? stack1.call(depth0, "new_channel", options) : helperMissing.call(depth0, "linkTo", "new_channel", options));
  if(stack2 || stack2 === 0) { data.buffer.push(stack2); }
  data.buffer.push("\n\n<table>\n  <thead>\n    <th>country_id</th>\n    <th>name</th>\n  </thead>\n  <tbody>\n    ");
  hashTypes = {};
  hashContexts = {};
  stack2 = helpers.each.call(depth0, "channel", "in", "controller", {hash:{},inverse:self.noop,fn:self.program(3, program3, data),contexts:[depth0,depth0,depth0],types:["ID","ID","ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data});
  if(stack2 || stack2 === 0) { data.buffer.push(stack2); }
  data.buffer.push("\n  </tbody>\n</table>\n\n\n");
  return buffer;
  
});

Ember.TEMPLATES['countries'] = Ember.Handlebars.template(function anonymous(Handlebars,depth0,helpers,partials,data) {
this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Ember.Handlebars.helpers); data = data || {};
  var buffer = '', stack1, stack2, hashTypes, hashContexts, options, escapeExpression=this.escapeExpression, self=this, helperMissing=helpers.helperMissing;

function program1(depth0,data) {
  
  
  data.buffer.push("New Country");
  }

function program3(depth0,data) {
  
  var buffer = '', stack1, stack2, hashTypes, hashContexts, options;
  data.buffer.push("\n    <tr>\n      <td>");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "country.language", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("</td>\n      <td>");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "country.name", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("</td>\n      <td>");
  hashTypes = {};
  hashContexts = {};
  options = {hash:{},inverse:self.noop,fn:self.program(4, program4, data),contexts:[depth0,depth0],types:["STRING","ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  stack2 = ((stack1 = helpers.linkTo || depth0.linkTo),stack1 ? stack1.call(depth0, "country", "country", options) : helperMissing.call(depth0, "linkTo", "country", "country", options));
  if(stack2 || stack2 === 0) { data.buffer.push(stack2); }
  data.buffer.push("</td>\n    </tr>\n    ");
  return buffer;
  }
function program4(depth0,data) {
  
  
  data.buffer.push("view");
  }

  data.buffer.push("<h2>Countries</h2>\n\n");
  hashTypes = {};
  hashContexts = {};
  options = {hash:{},inverse:self.noop,fn:self.program(1, program1, data),contexts:[depth0],types:["STRING"],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  stack2 = ((stack1 = helpers.linkTo || depth0.linkTo),stack1 ? stack1.call(depth0, "new_country", options) : helperMissing.call(depth0, "linkTo", "new_country", options));
  if(stack2 || stack2 === 0) { data.buffer.push(stack2); }
  data.buffer.push("\n\n<table>\n  <thead>\n    <th>language</th>\n    <th>name</th>\n  </thead>\n  <tbody>\n    ");
  hashTypes = {};
  hashContexts = {};
  stack2 = helpers.each.call(depth0, "country", "in", "controller", {hash:{},inverse:self.noop,fn:self.program(3, program3, data),contexts:[depth0,depth0,depth0],types:["ID","ID","ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data});
  if(stack2 || stack2 === 0) { data.buffer.push(stack2); }
  data.buffer.push("\n  </tbody>\n</table>\n\n\n");
  return buffer;
  
});

Ember.TEMPLATES['country'] = Ember.Handlebars.template(function anonymous(Handlebars,depth0,helpers,partials,data) {
this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Ember.Handlebars.helpers); data = data || {};
  var buffer = '', stack1, stack2, hashTypes, hashContexts, options, escapeExpression=this.escapeExpression, self=this, helperMissing=helpers.helperMissing;

function program1(depth0,data) {
  
  
  data.buffer.push("←All Countries");
  }

function program3(depth0,data) {
  
  
  data.buffer.push("Edit");
  }

  data.buffer.push("<h2>Country</h2>\n\n<p>\n  <b>Language:</b> ");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "language", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\n</p>\n\n<p>\n  <b>Name:</b> ");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "name", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\n</p>\n\n");
  hashTypes = {};
  hashContexts = {};
  options = {hash:{},inverse:self.noop,fn:self.program(1, program1, data),contexts:[depth0],types:["STRING"],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  stack2 = ((stack1 = helpers.linkTo || depth0.linkTo),stack1 ? stack1.call(depth0, "countries", options) : helperMissing.call(depth0, "linkTo", "countries", options));
  if(stack2 || stack2 === 0) { data.buffer.push(stack2); }
  data.buffer.push("\n");
  hashTypes = {};
  hashContexts = {};
  options = {hash:{},inverse:self.noop,fn:self.program(3, program3, data),contexts:[depth0,depth0],types:["STRING","ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  stack2 = ((stack1 = helpers.linkTo || depth0.linkTo),stack1 ? stack1.call(depth0, "edit_country", "model", options) : helperMissing.call(depth0, "linkTo", "edit_country", "model", options));
  if(stack2 || stack2 === 0) { data.buffer.push(stack2); }
  data.buffer.push("\n<a href=\"#\" ");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers.action.call(depth0, "destroy", {hash:{},contexts:[depth0],types:["STRING"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push(">Destroy</a>\n");
  return buffer;
  
});

Ember.TEMPLATES['edit_country'] = Ember.Handlebars.template(function anonymous(Handlebars,depth0,helpers,partials,data) {
this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Ember.Handlebars.helpers); data = data || {};
  var buffer = '', hashContexts, hashTypes, escapeExpression=this.escapeExpression;


  data.buffer.push("<h2>Country</h2>\n\n<form ");
  hashContexts = {'on': depth0};
  hashTypes = {'on': "STRING"};
  data.buffer.push(escapeExpression(helpers.action.call(depth0, "save", {hash:{
    'on': ("submit")
  },contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push(">\n  \n  <p>\n    <label for=\"language\">Language</label><br>\n    ");
  hashContexts = {'valueBinding': depth0,'id': depth0};
  hashTypes = {'valueBinding': "STRING",'id': "STRING"};
  data.buffer.push(escapeExpression(helpers.view.call(depth0, "Ember.TextField", {hash:{
    'valueBinding': ("language"),
    'id': ("language")
  },contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\n  </p>\n  \n  <p>\n    <label for=\"name\">Name</label><br>\n    ");
  hashContexts = {'valueBinding': depth0,'id': depth0};
  hashTypes = {'valueBinding': "STRING",'id': "STRING"};
  data.buffer.push(escapeExpression(helpers.view.call(depth0, "Ember.TextField", {hash:{
    'valueBinding': ("name"),
    'id': ("name")
  },contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\n  </p>\n  \n  <p>\n    <button type=\"submit\">Save</button>\n  </p>\n\n</form>\n\n");
  return buffer;
  
});

Ember.TEMPLATES['episode'] = Ember.Handlebars.template(function anonymous(Handlebars,depth0,helpers,partials,data) {
this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Ember.Handlebars.helpers); data = data || {};
  var buffer = '', stack1, stack2, hashTypes, hashContexts, options, escapeExpression=this.escapeExpression, self=this, helperMissing=helpers.helperMissing;

function program1(depth0,data) {
  
  
  data.buffer.push("←All Episodes");
  }

function program3(depth0,data) {
  
  
  data.buffer.push("Edit");
  }

  data.buffer.push("<h2>Episode</h2>\n\n<p>\n  <b>Show id:</b> ");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "show_id", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\n</p>\n\n<p>\n  <b>Episode id:</b> ");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "episode_id", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\n</p>\n\n<p>\n  <b>Season:</b> ");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "season", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\n</p>\n\n<p>\n  <b>Poster:</b> ");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "poster", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\n</p>\n\n<p>\n  <b>Date:</b> ");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "date", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\n</p>\n\n<p>\n  <b>Name:</b> ");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "name", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\n</p>\n\n<p>\n  <b>Summary:</b> ");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "summary", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\n</p>\n\n<p>\n  <b>Watched:</b> ");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "watched", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\n</p>\n\n");
  hashTypes = {};
  hashContexts = {};
  options = {hash:{},inverse:self.noop,fn:self.program(1, program1, data),contexts:[depth0],types:["STRING"],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  stack2 = ((stack1 = helpers.linkTo || depth0.linkTo),stack1 ? stack1.call(depth0, "episodes", options) : helperMissing.call(depth0, "linkTo", "episodes", options));
  if(stack2 || stack2 === 0) { data.buffer.push(stack2); }
  data.buffer.push("\n");
  hashTypes = {};
  hashContexts = {};
  options = {hash:{},inverse:self.noop,fn:self.program(3, program3, data),contexts:[depth0,depth0],types:["STRING","ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  stack2 = ((stack1 = helpers.linkTo || depth0.linkTo),stack1 ? stack1.call(depth0, "edit_episode", "model", options) : helperMissing.call(depth0, "linkTo", "edit_episode", "model", options));
  if(stack2 || stack2 === 0) { data.buffer.push(stack2); }
  data.buffer.push("\n<a href=\"#\" ");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers.action.call(depth0, "destroy", {hash:{},contexts:[depth0],types:["STRING"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push(">Destroy</a>\n");
  return buffer;
  
});

Ember.TEMPLATES['episodes'] = Ember.Handlebars.template(function anonymous(Handlebars,depth0,helpers,partials,data) {
this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Ember.Handlebars.helpers); data = data || {};
  var buffer = '', stack1, hashContexts, hashTypes, escapeExpression=this.escapeExpression, self=this;

function program1(depth0,data) {
  
  var buffer = '', stack1, hashTypes, hashContexts;
  data.buffer.push("\n    ");
  hashTypes = {};
  hashContexts = {};
  stack1 = helpers['if'].call(depth0, "e.hasSeen", {hash:{},inverse:self.program(4, program4, data),fn:self.program(2, program2, data),contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data});
  if(stack1 || stack1 === 0) { data.buffer.push(stack1); }
  data.buffer.push("\n      </tr>\n    ");
  return buffer;
  }
function program2(depth0,data) {
  
  var buffer = '', hashTypes, hashContexts;
  data.buffer.push("\n      <tr class=\"episode-watched\" id=\"");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers.unbound.call(depth0, "e.id", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\" ");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers.action.call(depth0, "toggleWatch", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push(">\n        <td>");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "e.season", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("</td>\n        <td>");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "e.episodeNum", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("</td>\n        <td>");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "e.name", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("</td>\n        <td>");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "e.summary", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("</td>\n        <td>");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "e.date", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("</td>\n      ");
  return buffer;
  }

function program4(depth0,data) {
  
  var buffer = '', hashTypes, hashContexts;
  data.buffer.push("\n        <tr id=\"");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers.unbound.call(depth0, "e.id", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\">\n        <td ");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers.action.call(depth0, "toggleWatch", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push(">");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "e.season", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("</td>\n        <td ");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers.action.call(depth0, "toggleWatch", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push(">");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "e.episodeNum", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("</td>\n        <td ");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers.action.call(depth0, "toggleWatch", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push(">");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "e.name", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("</td>\n        <td ");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers.action.call(depth0, "toggleWatch", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push(">");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "e.summary", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("</td>\n        <td ");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers.action.call(depth0, "toggleWatch", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push(">");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "e.date", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("</td>\n      ");
  return buffer;
  }

  data.buffer.push("<h2>Episodes</h2>\n\n\n<table class=\"table table-hover table-responsive datatable\">\n  <thead>\n    <th>Season</th>\n    <th>Episode</th>\n    <th>Name</th>\n    <th>Synopsis</th>\n    <th>Aired</th>\n  </thead>\n  <tbody>\n\n    ");
  hashContexts = {'itemController': depth0};
  hashTypes = {'itemController': "STRING"};
  stack1 = helpers.each.call(depth0, "e", "in", "controller", {hash:{
    'itemController': ("episode")
  },inverse:self.noop,fn:self.program(1, program1, data),contexts:[depth0,depth0,depth0],types:["ID","ID","ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data});
  if(stack1 || stack1 === 0) { data.buffer.push(stack1); }
  data.buffer.push("\n\n  </tbody>\n</table>");
  return buffer;
  
});

Ember.TEMPLATES['footer'] = Ember.Handlebars.template(function anonymous(Handlebars,depth0,helpers,partials,data) {
this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Ember.Handlebars.helpers); data = data || {};
  


  data.buffer.push("<section id=\"footer\">\n</section>");
  
});

Ember.TEMPLATES['index'] = Ember.Handlebars.template(function anonymous(Handlebars,depth0,helpers,partials,data) {
this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Ember.Handlebars.helpers); data = data || {};
  


  data.buffer.push("<h2>Index</h2>\n\n");
  
});

Ember.TEMPLATES['info'] = Ember.Handlebars.template(function anonymous(Handlebars,depth0,helpers,partials,data) {
this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Ember.Handlebars.helpers); data = data || {};
  var buffer = '', hashTypes, hashContexts, escapeExpression=this.escapeExpression;


  data.buffer.push("<div class=\"container\">\n	<h1>This should be fixed to markdown conversion</h1>\n	");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "info", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\n</div>");
  return buffer;
  
});

Ember.TEMPLATES['loading'] = Ember.Handlebars.template(function anonymous(Handlebars,depth0,helpers,partials,data) {
this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Ember.Handlebars.helpers); data = data || {};
  


  data.buffer.push("<div class=\"container\" id=\"loading-container\">\n	<img src=\"img/ajax-loader.gif\" class=\"loader\" />\n</div>");
  
});

Ember.TEMPLATES['login'] = Ember.Handlebars.template(function anonymous(Handlebars,depth0,helpers,partials,data) {
this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Ember.Handlebars.helpers); data = data || {};
  var buffer = '', stack1, hashTypes, hashContexts, options, helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;


  data.buffer.push("<div class=\"progress progress-striped browse-item-rating-progress topbar\" id=\"browse-show-rating-progress\">\n  \n  <div class=\"progress-bar progress-bar-info\" style=\"width: 100%\">\n    \n  </div>\n\n</div>\n\n<div class=\"container seethrough\">\n	<div class=\"row\">\n		<div class=\"col-lg-6\" class=\"loginpage-loginform-div\">\n				");
  hashTypes = {};
  hashContexts = {};
  options = {hash:{},contexts:[depth0],types:["STRING"],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  data.buffer.push(escapeExpression(((stack1 = helpers.partial || depth0.partial),stack1 ? stack1.call(depth0, "loginForm", options) : helperMissing.call(depth0, "partial", "loginForm", options))));
  data.buffer.push("\n		</div>\n		<div class=\"col-lg-6\" class=\"loginpage-signupform-div\">\n				");
  hashTypes = {};
  hashContexts = {};
  options = {hash:{},contexts:[depth0],types:["STRING"],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  data.buffer.push(escapeExpression(((stack1 = helpers.partial || depth0.partial),stack1 ? stack1.call(depth0, "signupForm", options) : helperMissing.call(depth0, "partial", "signupForm", options))));
  data.buffer.push("\n		</div>\n	</div>\n\n</div>\n");
  return buffer;
  
});

Ember.TEMPLATES['login_form'] = Ember.Handlebars.template(function anonymous(Handlebars,depth0,helpers,partials,data) {
this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Ember.Handlebars.helpers); data = data || {};
  var buffer = '', stack1, stack2, hashContexts, hashTypes, options, escapeExpression=this.escapeExpression, helperMissing=helpers.helperMissing, self=this;

function program1(depth0,data) {
  
  
  data.buffer.push("\n  		<div class=\"alert alert-danger alert-dismissable\">\n  			<p>Login failed :( Try again?</p>\n  		</div>\n  		");
  }

  data.buffer.push("<div class=\"row\">\n	<div class=\"col-lg-12\">\n		<h2>Do you have an account...</h2>\n	</div>\n</div>\n<div class=\"row\">\n	<form class=\"form-inline\" id=\"login-form\" ");
  hashContexts = {'on': depth0};
  hashTypes = {'on': "STRING"};
  data.buffer.push(escapeExpression(helpers.action.call(depth0, "authenticate", {hash:{
    'on': ("submit")
  },contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push(">\n  	<div class=\"col-lg-5 loginusername-area\">\n  		");
  hashContexts = {'id': depth0,'placeholder': depth0,'class': depth0,'value': depth0,'focus-out': depth0};
  hashTypes = {'id': "STRING",'placeholder': "STRING",'class': "STRING",'value': "ID",'focus-out': "STRING"};
  options = {hash:{
    'id': ("identification"),
    'placeholder': ("Enter Login"),
    'class': ("form-control"),
    'value': ("identification"),
    'focus-out': ("validateLoginEmail")
  },contexts:[],types:[],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  data.buffer.push(escapeExpression(((stack1 = helpers.input || depth0.input),stack1 ? stack1.call(depth0, options) : helperMissing.call(depth0, "input", options))));
  data.buffer.push("\n  		\n  	</div>\n  	<div class=\"alert alert-warning col-lg-4 alert-dismissable\" style=\"display:none;margin:auto auto;\" id=\"emailwarning\"> <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><b>Oh come on.. :( Your email sucks, man</div>\n</div>\n<div class=\"row\">\n  	<div class=\"col-lg-5 loginpw-area\">\n  		");
  hashContexts = {'id': depth0,'placeholder': depth0,'class': depth0,'type': depth0,'value': depth0};
  hashTypes = {'id': "STRING",'placeholder': "STRING",'class': "STRING",'type': "STRING",'value': "ID"};
  options = {hash:{
    'id': ("password"),
    'placeholder': ("Enter Password"),
    'class': ("form-control"),
    'type': ("password"),
    'value': ("password")
  },contexts:[],types:[],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  data.buffer.push(escapeExpression(((stack1 = helpers.input || depth0.input),stack1 ? stack1.call(depth0, options) : helperMissing.call(depth0, "input", options))));
  data.buffer.push("\n\n  	</div>\n</div>\n<div class=\"row\">\n  	<div class=\"col-lg-5\">\n  		");
  hashTypes = {};
  hashContexts = {};
  stack2 = helpers['if'].call(depth0, "loginFailed", {hash:{},inverse:self.noop,fn:self.program(1, program1, data),contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data});
  if(stack2 || stack2 === 0) { data.buffer.push(stack2); }
  data.buffer.push("\n  		\n  		<button class=\"btn btn-info\" >Log in</button>\n\n  	</div>\n</form>\n</div>");
  return buffer;
  
});

Ember.TEMPLATES['navigation'] = Ember.Handlebars.template(function anonymous(Handlebars,depth0,helpers,partials,data) {
this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Ember.Handlebars.helpers); data = data || {};
  var buffer = '', stack1, stack2, hashTypes, hashContexts, options, escapeExpression=this.escapeExpression, self=this, helperMissing=helpers.helperMissing;

function program1(depth0,data) {
  
  var buffer = '', hashTypes, hashContexts;
  data.buffer.push("\n	        <button class=\"btn navbar-btn btn-danger btn-lg login-btn\"");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers.action.call(depth0, "invalidateSession", {hash:{},contexts:[depth0],types:["STRING"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push(">Log out</button>\n	        ");
  return buffer;
  }

function program3(depth0,data) {
  
  var buffer = '', stack1, stack2, hashContexts, hashTypes, options;
  data.buffer.push("\n	        ");
  hashContexts = {'animations': depth0};
  hashTypes = {'animations': "STRING"};
  options = {hash:{
    'animations': ("main:slideRight")
  },inverse:self.noop,fn:self.program(4, program4, data),contexts:[depth0],types:["STRING"],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  stack2 = ((stack1 = helpers['link-to-animated'] || depth0['link-to-animated']),stack1 ? stack1.call(depth0, "login", options) : helperMissing.call(depth0, "link-to-animated", "login", options));
  if(stack2 || stack2 === 0) { data.buffer.push(stack2); }
  data.buffer.push("\n	        ");
  return buffer;
  }
function program4(depth0,data) {
  
  
  data.buffer.push("<button class=\"btn navbar-btn btn-primary btn-lg login-btn\">Log in</button>");
  }

function program6(depth0,data) {
  
  
  data.buffer.push("\n						<div data-icon=\"&#xe078;\" class=\"icon navlink\" style=\"color:white;\"></div>\n					");
  }

function program8(depth0,data) {
  
  
  data.buffer.push("\n					<div data-icon=\"&#xe021;\" class=\"icon navlink\" style=\"color:white;\"></div>\n				");
  }

function program10(depth0,data) {
  
  
  data.buffer.push("\n						<div data-icon=\"&#xe067;\" class=\"icon navlink\" style=\"color:white;\"></div>\n					");
  }

function program12(depth0,data) {
  
  
  data.buffer.push("\n						<div data-icon=\"&#xe027;\" class=\"icon navlink\" style=\"color:white;\"></div>\n					");
  }

function program14(depth0,data) {
  
  
  data.buffer.push("\n					<div data-icon=\"&#xe072;\" class=\"icon navlink\" style=\"color:white;\"></div>\n					");
  }

function program16(depth0,data) {
  
  var buffer = '', hashTypes, hashContexts;
  data.buffer.push(" ");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "App.name", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push(" ");
  return buffer;
  }

  data.buffer.push("<nav class=\"navbar navbar-default navbar-fixed-top\" role=\"navigation\">\n\n	    <div> \n	        ");
  hashTypes = {};
  hashContexts = {};
  stack1 = helpers['if'].call(depth0, "session.isAuthenticated", {hash:{},inverse:self.program(3, program3, data),fn:self.program(1, program1, data),contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data});
  if(stack1 || stack1 === 0) { data.buffer.push(stack1); }
  data.buffer.push("\n	    </div>\n	    <div class=\"navbar-header col-lg-12 navbar-btn\">\n		    <ul id=\"sidebar-icons\">\n				<!-- Link to index -->\n				<li data-toggle=\"tooltip\" data-placement=\"right\" title=\"All shows\" data-original-title=\"All shows\">\n					");
  hashContexts = {'animations': depth0};
  hashTypes = {'animations': "STRING"};
  options = {hash:{
    'animations': ("main:slideOverRight")
  },inverse:self.noop,fn:self.program(6, program6, data),contexts:[depth0],types:["STRING"],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  stack2 = ((stack1 = helpers['link-to-animated'] || depth0['link-to-animated']),stack1 ? stack1.call(depth0, "index", options) : helperMissing.call(depth0, "link-to-animated", "index", options));
  if(stack2 || stack2 === 0) { data.buffer.push(stack2); }
  data.buffer.push("\n				</li>\n				\n				<!-- Link to calendar view -->\n				<li data-toggle=\"tooltip\" data-placement=\"right\" title=\"New episodes\" data-original-title=\"New episodes\">\n				");
  hashContexts = {'animations': depth0};
  hashTypes = {'animations': "STRING"};
  options = {hash:{
    'animations': ("main:slideOverRight")
  },inverse:self.noop,fn:self.program(8, program8, data),contexts:[depth0],types:["STRING"],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  stack2 = ((stack1 = helpers['link-to-animated'] || depth0['link-to-animated']),stack1 ? stack1.call(depth0, "calendar", options) : helperMissing.call(depth0, "link-to-animated", "calendar", options));
  if(stack2 || stack2 === 0) { data.buffer.push(stack2); }
  data.buffer.push("\n				</li>\n				\n				<!-- Link to watched shows -->\n				<li data-toggle=\"tooltip\" data-placement=\"right\" title=\"The shows you follow\" data-original-title=\"The shows you follow\">\n					");
  hashContexts = {'animations': depth0};
  hashTypes = {'animations': "STRING"};
  options = {hash:{
    'animations': ("main:slideOverRight")
  },inverse:self.noop,fn:self.program(10, program10, data),contexts:[depth0],types:["STRING"],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  stack2 = ((stack1 = helpers['link-to-animated'] || depth0['link-to-animated']),stack1 ? stack1.call(depth0, "watched", options) : helperMissing.call(depth0, "link-to-animated", "watched", options));
  if(stack2 || stack2 === 0) { data.buffer.push(stack2); }
  data.buffer.push("\n				</li>\n				\n				<!-- Link to Account settings -->\n				<li data-toggle=\"tooltip\" data-placement=\"right\" title=\"Your account settings\" data-original-title=\"Your account settings\">\n					");
  hashContexts = {'animations': depth0};
  hashTypes = {'animations': "STRING"};
  options = {hash:{
    'animations': ("main:slideOverRight")
  },inverse:self.noop,fn:self.program(12, program12, data),contexts:[depth0],types:["STRING"],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  stack2 = ((stack1 = helpers['link-to-animated'] || depth0['link-to-animated']),stack1 ? stack1.call(depth0, "account", options) : helperMissing.call(depth0, "link-to-animated", "account", options));
  if(stack2 || stack2 === 0) { data.buffer.push(stack2); }
  data.buffer.push("\n				</li>\n				\n				<!-- Link to info page -->\n				<li data-toggle=\"tooltip\" data-placement=\"right\" title=\"Help, if you need\" data-original-title=\"Help, if you need\">\n					");
  hashContexts = {'animations': depth0};
  hashTypes = {'animations': "STRING"};
  options = {hash:{
    'animations': ("main:slideOverRight")
  },inverse:self.noop,fn:self.program(14, program14, data),contexts:[depth0],types:["STRING"],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  stack2 = ((stack1 = helpers['link-to-animated'] || depth0['link-to-animated']),stack1 ? stack1.call(depth0, "info", options) : helperMissing.call(depth0, "link-to-animated", "info", options));
  if(stack2 || stack2 === 0) { data.buffer.push(stack2); }
  data.buffer.push("\n				</li>\n			</ul>\n			");
  hashContexts = {'class': depth0,'id': depth0};
  hashTypes = {'class': "STRING",'id': "STRING"};
  options = {hash:{
    'class': ("navbar-brand"),
    'id': ("navbar-brand")
  },inverse:self.noop,fn:self.program(16, program16, data),contexts:[depth0],types:["STRING"],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  stack2 = ((stack1 = helpers['link-to'] || depth0['link-to']),stack1 ? stack1.call(depth0, "index", options) : helperMissing.call(depth0, "link-to", "index", options));
  if(stack2 || stack2 === 0) { data.buffer.push(stack2); }
  data.buffer.push("\n		</div>\n\n  </nav>");
  return buffer;
  
});

Ember.TEMPLATES['searchbox'] = Ember.Handlebars.template(function anonymous(Handlebars,depth0,helpers,partials,data) {
this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Ember.Handlebars.helpers); data = data || {};
  


  data.buffer.push("<h2>searchbox</h2>\n\n");
  
});

Ember.TEMPLATES['show'] = Ember.Handlebars.template(function anonymous(Handlebars,depth0,helpers,partials,data) {
this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Ember.Handlebars.helpers); data = data || {};
  var buffer = '', stack1, stack2, hashTypes, hashContexts, options, escapeExpression=this.escapeExpression, self=this, helperMissing=helpers.helperMissing;

function program1(depth0,data) {
  
  var buffer = '', hashTypes, hashContexts;
  data.buffer.push("\n        <a class=\"tiny button radius\" ");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers.action.call(depth0, "follow", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push(">Add to watchlist</a>\n        \n      ");
  return buffer;
  }

function program3(depth0,data) {
  
  var buffer = '', hashTypes, hashContexts;
  data.buffer.push("\n        <button id=\"");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers.unbound.call(depth0, "id", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\" class=\"btn btn-danger btn-lg\" ");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers.action.call(depth0, "follow", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push(">Unfollow</button>\n      ");
  return buffer;
  }

function program5(depth0,data) {
  
  
  data.buffer.push("←All Shows");
  }

  data.buffer.push("\n<div class=\"progress progress-striped browse-item-rating-progress topbar\" id=\"browse-show-rating-progress\">\n  \n  <div class=\"progress-bar ");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers.unbound.call(depth0, "progressType", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\" style=\"width: ");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers.unbound.call(depth0, "ratingLength", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("%\">\n    <div id=\"browse-show-rating\">");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "ratingText", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("</div>\n  </div>\n\n</div>\n\n<div class=\"container\">\n\n<div class=\"row\">\n    <div class=\"col-lg-4\">\n      <img src=\"../media/posters/");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers.unbound.call(depth0, "poster", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\" class=\"detailsimg\"/>\n    </div>\n    <div class=\"col-lg-8 columns\">\n      <div class=\"row\">\n        <div class=\"col-lg-8 columns\">\n          <h1>");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "name", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("</h1>\n        </div>\n      </div>\n      <div class=\"row\">\n        \n      </div>\n      <div class=\"row\">\n        <div class=\"col-lg-8 columns\">\n          <p>");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "summary", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("</p>\n        </div>\n      </div>\n      ");
  hashTypes = {};
  hashContexts = {};
  stack1 = helpers['if'].call(depth0, "isFollowing", {hash:{},inverse:self.program(3, program3, data),fn:self.program(1, program1, data),contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data});
  if(stack1 || stack1 === 0) { data.buffer.push(stack1); }
  data.buffer.push("\n    </div>\n  </div>\n  <div class=\"row\">\n    <div class=\"col-lg-4 columns\">\n      <ul class=\"inline-list\">\n      \n      </ul>\n    </div>\n  </div>\n  <div class=\"row\">&nbsp;</div>\n  <div class=\"row\">&nbsp;</div>\n\n");
  data.buffer.push("\n");
  hashTypes = {};
  hashContexts = {};
  options = {hash:{},contexts:[depth0,depth0],types:["STRING","ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  data.buffer.push(escapeExpression(((stack1 = helpers.render || depth0.render),stack1 ? stack1.call(depth0, "episodes", "episodes", options) : helperMissing.call(depth0, "render", "episodes", "episodes", options))));
  data.buffer.push("\n\n\n\n");
  hashContexts = {'animations': depth0};
  hashTypes = {'animations': "STRING"};
  options = {hash:{
    'animations': ("main:slideLeft")
  },inverse:self.noop,fn:self.program(5, program5, data),contexts:[depth0],types:["STRING"],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  stack2 = ((stack1 = helpers['link-to-animated'] || depth0['link-to-animated']),stack1 ? stack1.call(depth0, "index", options) : helperMissing.call(depth0, "link-to-animated", "index", options));
  if(stack2 || stack2 === 0) { data.buffer.push(stack2); }
  return buffer;
  
});

Ember.TEMPLATES['shows'] = Ember.Handlebars.template(function anonymous(Handlebars,depth0,helpers,partials,data) {
this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Ember.Handlebars.helpers); data = data || {};
  var buffer = '', stack1, hashContexts, hashTypes, escapeExpression=this.escapeExpression, self=this, helperMissing=helpers.helperMissing;

function program1(depth0,data) {
  
  var buffer = '', stack1, hashTypes, hashContexts;
  data.buffer.push("\n    ");
  hashTypes = {};
  hashContexts = {};
  stack1 = helpers['if'].call(depth0, "show.matchFilter", {hash:{},inverse:self.noop,fn:self.program(2, program2, data),contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data});
  if(stack1 || stack1 === 0) { data.buffer.push(stack1); }
  data.buffer.push("\n    ");
  return buffer;
  }
function program2(depth0,data) {
  
  var buffer = '', stack1, stack2, hashTypes, hashContexts, options;
  data.buffer.push("\n    <div class=\"item col-md-3 browse-list browse-item overlay-trigger\" id=\"");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers.unbound.call(depth0, "show.id", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\">\n          <div class=\"progress browse-item-rating-progress\">\n            \n            <div class=\"progress-bar ");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers.unbound.call(depth0, "show.progressType", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\" style=\"width: ");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers.unbound.call(depth0, "ratingLength", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("%\">\n              <div class=\"browse-item-rating\">");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "show.ratingText", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("</div>\n            </div>\n        \n          </div>\n          <div class=\"browse-item-splitter\">\n            ");
  hashContexts = {'animations': depth0};
  hashTypes = {'animations': "STRING"};
  options = {hash:{
    'animations': ("main:slideRight")
  },inverse:self.noop,fn:self.program(3, program3, data),contexts:[depth0,depth0],types:["STRING","ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  stack2 = ((stack1 = helpers['link-to-animated'] || depth0['link-to-animated']),stack1 ? stack1.call(depth0, "show", "show", options) : helperMissing.call(depth0, "link-to-animated", "show", "show", options));
  if(stack2 || stack2 === 0) { data.buffer.push(stack2); }
  data.buffer.push("\n          </div>\n          ");
  hashTypes = {};
  hashContexts = {};
  stack2 = helpers['if'].call(depth0, "show.isLoggedIn", {hash:{},inverse:self.noop,fn:self.program(5, program5, data),contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data});
  if(stack2 || stack2 === 0) { data.buffer.push(stack2); }
  data.buffer.push("\n        </div>\n    ");
  return buffer;
  }
function program3(depth0,data) {
  
  var buffer = '', hashTypes, hashContexts;
  data.buffer.push("\n              <img src=\"../media/posters/");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers.unbound.call(depth0, "show.poster", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\" alt=\"media/posters/");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers.unbound.call(depth0, "show.poster", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\" />\n            \n            \n              <h5>");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "show.name", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("</h5>\n            ");
  return buffer;
  }

function program5(depth0,data) {
  
  var buffer = '', stack1, stack2, hashTypes, hashContexts, options;
  data.buffer.push("\n          <div class=\"browse-item-actions\">\n             \n            ");
  hashTypes = {};
  hashContexts = {};
  stack1 = helpers['if'].call(depth0, "show.notFollowing", {hash:{},inverse:self.program(8, program8, data),fn:self.program(6, program6, data),contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data});
  if(stack1 || stack1 === 0) { data.buffer.push(stack1); }
  data.buffer.push(" \n              \n              ");
  hashContexts = {'animations': depth0};
  hashTypes = {'animations': "STRING"};
  options = {hash:{
    'animations': ("main:slideRight")
  },inverse:self.noop,fn:self.program(10, program10, data),contexts:[depth0,depth0],types:["STRING","ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  stack2 = ((stack1 = helpers['link-to-animated'] || depth0['link-to-animated']),stack1 ? stack1.call(depth0, "show", "show", options) : helperMissing.call(depth0, "link-to-animated", "show", "show", options));
  if(stack2 || stack2 === 0) { data.buffer.push(stack2); }
  data.buffer.push("\n              \n              <div class=\"clear\">&nbsp;</div>\n          </div>\n          ");
  return buffer;
  }
function program6(depth0,data) {
  
  var buffer = '', hashTypes, hashContexts;
  data.buffer.push("\n              <button class=\"btn btn-small btn-primary follow-button\" ");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers.action.call(depth0, "follow", "show.id", {hash:{},contexts:[depth0,depth0],types:["ID","ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("> +Follow</button>\n            ");
  return buffer;
  }

function program8(depth0,data) {
  
  
  data.buffer.push("\n              <button class=\"btn btn-small follow-button-grey\"><i>Following</i></button>\n            ");
  }

function program10(depth0,data) {
  
  
  data.buffer.push("<button class=\"btn btn-small btn-info read-more-button\"> More </button>");
  }

  data.buffer.push("\n<div class=\"col-lg-12\" class=\"topbar\" id=\"search-area\"> \n      <!-- Right Nav Section --> \n        <form method=\"get\" ");
  hashContexts = {'on': depth0};
  hashTypes = {'on': "STRING"};
  data.buffer.push(escapeExpression(helpers.action.call(depth0, "update", {hash:{
    'on': ("submit")
  },contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push(">\n          ");
  hashContexts = {'valueBinding': depth0,'placeholder': depth0,'keyDown': depth0};
  hashTypes = {'valueBinding': "STRING",'placeholder': "STRING",'keyDown': "STRING"};
  data.buffer.push(escapeExpression(helpers.view.call(depth0, "Ember.TextField", {hash:{
    'valueBinding': ("search_text"),
    'placeholder': ("Type to filter, hit enter to search"),
    'keyDown': ("filterGrid")
  },contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\n        </form>\n</div>\n\n<div class=\"container seethrough\">\n<div class=\"row\">\n  \n    ");
  hashTypes = {};
  hashContexts = {};
  stack1 = helpers.each.call(depth0, "show", "in", "controller", {hash:{},inverse:self.noop,fn:self.program(1, program1, data),contexts:[depth0,depth0,depth0],types:["ID","ID","ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data});
  if(stack1 || stack1 === 0) { data.buffer.push(stack1); }
  data.buffer.push("\n</div>\n<div class=\"row\">\n<button class=\"col-lg-12 btn btn-info\" ");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers.action.call(depth0, "forward", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push(">Load more</button>\n</div>\n</div>");
  return buffer;
  
});

Ember.TEMPLATES['signup_form'] = Ember.Handlebars.template(function anonymous(Handlebars,depth0,helpers,partials,data) {
this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Ember.Handlebars.helpers); data = data || {};
  var buffer = '', stack1, hashContexts, hashTypes, options, escapeExpression=this.escapeExpression, helperMissing=helpers.helperMissing;


  data.buffer.push("<div class=\"row\">\n	<div class=\"col-lg-12\">\n		<h2>.. or are you not registered yet? :(</h2>\n	</div>\n</div>\n<div class=\"row\">\n	<form class=\"form-inline\" ");
  hashContexts = {'on': depth0};
  hashTypes = {'on': "STRING"};
  data.buffer.push(escapeExpression(helpers.action.call(depth0, "signUp", {hash:{
    'on': ("submit")
  },contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push(">\n  	<div class=\"col-lg-5 signupemail-area\">\n  		");
  hashContexts = {'value': depth0,'type': depth0,'value': depth0,'placeholder': depth0,'focus-out': depth0};
  hashTypes = {'value': "ID",'type': "STRING",'value': "ID",'placeholder': "STRING",'focus-out': "STRING"};
  options = {hash:{
    'value': ("username"),
    'type': ("text"),
    'value': ("signupEmail"),
    'placeholder': ("E-mail"),
    'focus-out': ("validateSignupEmail")
  },contexts:[],types:[],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  data.buffer.push(escapeExpression(((stack1 = helpers.input || depth0.input),stack1 ? stack1.call(depth0, options) : helperMissing.call(depth0, "input", options))));
  data.buffer.push("\n  		\n  	</div>\n  	<div class=\"alert alert-warning col-lg-4 alert-dismissable\" style=\"display:none;margin:auto auto;\" id=\"signupemailwarning\"> \n  			<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>\n  			<b>Oh come on..</b> :( Your email sucks, man\n  		</div>\n</div>\n<div class=\"row\">\n  	<div class=\"col-lg-5 signuppw-area\">\n  		");
  hashContexts = {'value': depth0,'type': depth0,'value': depth0,'placeholder': depth0,'focus-out': depth0};
  hashTypes = {'value': "ID",'type': "STRING",'value': "ID",'placeholder': "STRING",'focus-out': "STRING"};
  options = {hash:{
    'value': ("password"),
    'type': ("password"),
    'value': ("signupPassword"),
    'placeholder': ("Password"),
    'focus-out': ("validateSignupPw")
  },contexts:[],types:[],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  data.buffer.push(escapeExpression(((stack1 = helpers.input || depth0.input),stack1 ? stack1.call(depth0, options) : helperMissing.call(depth0, "input", options))));
  data.buffer.push("\n  	</div>\n  	<div class=\"alert alert-info col-lg-4 alert-dismissable\" style=\"display:none;margin:auto auto;\" id=\"passwordwarning\"> \n  			<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>\n  			<b>Alright, so ...</b> 8 or more characters. At least a number, an uppercase letter and a lowercase letter. Deal?\n  	</div>\n</div>\n<div class=\"row\">\n  	<div class=\"col-lg-5 signupverify-area\">\n  		");
  hashContexts = {'value': depth0,'type': depth0,'value': depth0,'placeholder': depth0,'focus-out': depth0};
  hashTypes = {'value': "ID",'type': "STRING",'value': "ID",'placeholder': "STRING",'focus-out': "STRING"};
  options = {hash:{
    'value': ("password"),
    'type': ("password"),
    'value': ("signupVerify"),
    'placeholder': ("Verify plz"),
    'focus-out': ("validateSignupVerification")
  },contexts:[],types:[],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  data.buffer.push(escapeExpression(((stack1 = helpers.input || depth0.input),stack1 ? stack1.call(depth0, options) : helperMissing.call(depth0, "input", options))));
  data.buffer.push("\n  		\n  	</div>\n  	<div class=\"alert alert-warning col-lg-4 alert-dismissable\" style=\"display:none;margin:auto auto;\" id=\"verifywarning\"> \n  			<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>\n  			<b>Uhm..</b> Your passwords must, you know, match :/</b>\n  		</div>\n</div>\n<div class=\"row\">\n  	<div class=\"col-lg-5\">\n  		");
  hashContexts = {'class': depth0,'disabled': depth0,'type': depth0,'value': depth0};
  hashTypes = {'class': "STRING",'disabled': "ID",'type': "STRING",'value': "STRING"};
  options = {hash:{
    'class': ("btn btn-success"),
    'disabled': ("signupFormIsValid"),
    'type': ("submit"),
    'value': ("Sign up")
  },contexts:[],types:[],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  data.buffer.push(escapeExpression(((stack1 = helpers.input || depth0.input),stack1 ? stack1.call(depth0, options) : helperMissing.call(depth0, "input", options))));
  data.buffer.push("\n  	</div>\n</form>\n</div>");
  return buffer;
  
});

Ember.TEMPLATES['user'] = Ember.Handlebars.template(function anonymous(Handlebars,depth0,helpers,partials,data) {
this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Ember.Handlebars.helpers); data = data || {};
  var buffer = '', stack1, hashTypes, hashContexts, escapeExpression=this.escapeExpression, self=this;

function program1(depth0,data) {
  
  var buffer = '', hashTypes, hashContexts;
  data.buffer.push("\n	");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "show.name", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\n");
  return buffer;
  }

  data.buffer.push("<h2>user</h2>\n");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "email", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\n");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "password", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\n");
  hashTypes = {};
  hashContexts = {};
  stack1 = helpers.each.call(depth0, "show", "in", "shows", {hash:{},inverse:self.noop,fn:self.program(1, program1, data),contexts:[depth0,depth0,depth0],types:["ID","ID","ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data});
  if(stack1 || stack1 === 0) { data.buffer.push(stack1); }
  return buffer;
  
});

Ember.TEMPLATES['watched'] = Ember.Handlebars.template(function anonymous(Handlebars,depth0,helpers,partials,data) {
this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Ember.Handlebars.helpers); data = data || {};
  var buffer = '', stack1, hashTypes, hashContexts, escapeExpression=this.escapeExpression, self=this, helperMissing=helpers.helperMissing;

function program1(depth0,data) {
  
  var buffer = '', stack1, stack2, hashTypes, hashContexts, options;
  data.buffer.push("\n    <div class=\"item col-md-3 browse-list browse-item overlay-trigger\" id=\"");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers.unbound.call(depth0, "show.id", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\">\n          <div class=\"progress browse-item-rating-progress\">\n            \n            <div class=\"progress-bar ");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers.unbound.call(depth0, "show.progressType", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\" style=\"width: ");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers.unbound.call(depth0, "ratingLength", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("%\">\n              <div class=\"browse-item-rating\">");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "show.ratingText", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("</div>\n            </div>\n        \n          </div>\n          <div class=\"browse-item-splitter\">\n            ");
  hashContexts = {'animations': depth0};
  hashTypes = {'animations': "STRING"};
  options = {hash:{
    'animations': ("main:slideRight")
  },inverse:self.noop,fn:self.program(2, program2, data),contexts:[depth0,depth0],types:["STRING","ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data};
  stack2 = ((stack1 = helpers['link-to-animated'] || depth0['link-to-animated']),stack1 ? stack1.call(depth0, "show", "show", options) : helperMissing.call(depth0, "link-to-animated", "show", "show", options));
  if(stack2 || stack2 === 0) { data.buffer.push(stack2); }
  data.buffer.push("\n          </div>\n        </div>\n    ");
  return buffer;
  }
function program2(depth0,data) {
  
  var buffer = '', hashTypes, hashContexts;
  data.buffer.push("\n              <img src=\"../media/posters/");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers.unbound.call(depth0, "show.poster", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\" alt=\"media/posters/");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers.unbound.call(depth0, "show.poster", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("\" />\n            \n            \n              <h5>");
  hashTypes = {};
  hashContexts = {};
  data.buffer.push(escapeExpression(helpers._triageMustache.call(depth0, "show.name", {hash:{},contexts:[depth0],types:["ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data})));
  data.buffer.push("</h5>\n            ");
  return buffer;
  }

  data.buffer.push("<div class=\"progress progress-striped browse-item-rating-progress\" id=\"browse-show-rating-progress\">\n  \n  <div class=\"progress-bar progress-bar-success\" style=\"width: 100%\">\n    <div id=\"browse-show-rating\">Following</div>\n  </div>\n\n</div>\n<div class=\"container\">\n<div class=\"row\" id=\"watched\">\n  \n    ");
  hashTypes = {};
  hashContexts = {};
  stack1 = helpers.each.call(depth0, "show", "in", "controller", {hash:{},inverse:self.noop,fn:self.program(1, program1, data),contexts:[depth0,depth0,depth0],types:["ID","ID","ID"],hashContexts:hashContexts,hashTypes:hashTypes,data:data});
  if(stack1 || stack1 === 0) { data.buffer.push(stack1); }
  data.buffer.push("\n</div>\n\n</div>");
  return buffer;
  
});

Ember.TEMPLATES['watched_show'] = Ember.Handlebars.template(function anonymous(Handlebars,depth0,helpers,partials,data) {
this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Ember.Handlebars.helpers); data = data || {};
  


  data.buffer.push("<h2>WatchedShow</h2>\n\n");
  
});



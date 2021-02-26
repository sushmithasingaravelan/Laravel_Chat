  
   
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"> <a href="#">Send Messages</a></div>

                <div class="panel-body">

                <form class="form-group form-horizontal" name="area_config">
                <label>Select Sender<span class="red">*</span></label>
                <select class="form-control mb-1" ng-model="data.to_user"
                                ng-options="sender.id as sender.name for sender in senderList">
                                <option disabled value =''>Select Option</option>
                </select>
                <textarea class="form-control mb-1" ng-model="data.message"  placeholder="Leave your message here.." rows="5" id="comment"></textarea>
                <button type="button" ng-if="data.message.length > 0" class="btn btn-submit mb-1" ng-click="sendMessage(data)">
                                <span>Send</span>
                </button>
                </form>

                        </div>
                </div>
            </div>
        </div>
         <div class="col-md-4 ">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="#"> Get All Messages</a></div>

                <div class="panel-body">

               <ul class="links">
                    <li class="" ng-repeat="msg in AllList">
                    
                    <b class="mt-0" ng-bind="msg.name"></b>
                    <div ng-repeat="msginfo in msg.chat">
                    <p ng-class="{'text-right': msginfo.type , 'text-left': !msginfo.type}"><span ng-if="msginfo.type">Replied: </span><span ng-bind="msginfo.content"></span></p>
                    
                    </div>
                     <hr></li>
                   <li class="" ng-if="AllList.length < 1">
                   <p>No messages to read..</p></li>
                   </ul>
                </div>
                </div>
            </div>
             <div class="col-md-4 ">
            <div class="panel panel-default">
                <div class="panel-heading"> <a href="#">Get Last Messages of every chat</a></div>

               <div class="panel-body">

               <ul class="links">
                    <li class="" ng-repeat="last in lastList">
                    
                    <b class="mt-0" ng-bind="last.name"></b>
                    <p ng-bind="last.content"></p> <hr></li>
                   <li class="" ng-if="lastList.length < 1">
                   <p>No messages to read..</p></li>
                   </ul>
                </div>
                </div>
            </div>
             <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading"> <a href="#" ng-click="sendMessage(data)" > Get Unread Message - <span ng-bind="message_count"></span> </a> </div>
                <div class="panel-body">


               <ul class="links">
                    <li class="" ng-repeat="unread in unreadList">
                    <input type="checkbox"  ng-click="markRead(unread)" /> &nbsp; Mark as Read <br>
                    <b class="mt-0" ng-bind="unread.name"></b>
                    <p ng-bind="unread.content"></p> <hr></li>
                   <li class="" ng-if="unreadList.length < 1">
                   <p>No messages to read..</p></li>
                   </ul>
                        </div>
              
               
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

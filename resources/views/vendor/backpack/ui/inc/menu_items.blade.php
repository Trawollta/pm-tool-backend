{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-item title="Channels" icon="la la-question" :link="backpack_url('channel')" />
<x-backpack::menu-item title="Tasks" icon="la la-question" :link="backpack_url('task')" />
<x-backpack::menu-item title="Users" icon="la la-question" :link="backpack_url('user')" />
<x-backpack::menu-item title="Members" icon="la la-question" :link="backpack_url('members')" />
<x-backpack::menu-item title="Categories" icon="la la-question" :link="backpack_url('category')" />
<x-backpack::menu-item title="Subtasks" icon="la la-question" :link="backpack_url('subtask')" />
<x-backpack::menu-item title="Boards" icon="la la-question" :link="backpack_url('board')" />
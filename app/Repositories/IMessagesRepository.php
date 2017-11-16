<?php

namespace App\Repositories;

interface IMessagesRepository {

    public function getPaginatedMessages();
    public function storeMessage($request);
    public function findById($id);
    public function update($request, $id);
    public function destroy($id);
}
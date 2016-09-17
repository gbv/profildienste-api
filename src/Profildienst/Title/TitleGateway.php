<?php

namespace Profildienst\Title;


interface TitleGateway {

    public function getTitlesById(array $titleIds);
    public function getTitlesByStatus($status, $page, $dateSorted);
    public function getAllTitlesByStatus($status);
    public function getTitleCountWithStatus($status);
    public function deleteTitle($id);
    public function updateTitlesWithStatus($oldStatus, $newStatus);
    public function updateTitlesWithIds(array $ids, $newStatus);
    public function updateTitlesOrderInformation(array $ids, $orderInformation);
    public function updateTitlesInWatchlist($watchlistId, $newStatus);
    /* TODO: Currently unsupported
    public function updateViewOrderInformation(array $ids, $orderInformation); */
}
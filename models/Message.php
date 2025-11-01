<?php

/**
 * Entité Message
 * Représente un message privé
 */
class Message
{
    private $id;
    private $senderId;
    private $receiverId;
    private $content;
    private $sendAt;
    private $messageRead;
    private $senderPseudo;
    private $senderAvatar;

    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->senderId = $data['sender_id'] ?? ($data['senderId'] ?? null);
        $this->receiverId = $data['receiver_id'] ?? ($data['receiverId'] ?? null);
        $this->content = $data['content'] ?? null;
        $this->sendAt = $data['send_at'] ?? ($data['sendAt'] ?? null);
        $this->messageRead = isset($data['message_read']) ? (bool)$data['message_read'] : (isset($data['messageRead']) ? (bool)$data['messageRead'] : false);
        $this->senderPseudo = $data['pseudo'] ?? ($data['sender_pseudo'] ?? null);
        $this->senderAvatar = $data['avatar'] ?? ($data['sender_avatar'] ?? null);
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'sender_id' => $this->senderId,
            'receiver_id' => $this->receiverId,
            'content' => $this->content,
            'send_at' => $this->sendAt,
            'message_read' => $this->messageRead,
            'pseudo' => $this->senderPseudo,
            'avatar' => $this->senderAvatar,
        ];
    }

    // Getters / Setters
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    public function getSenderId()
    {
        return $this->senderId;
    }
    public function setSenderId($v)
    {
        $this->senderId = $v;
        return $this;
    }
    public function getReceiverId()
    {
        return $this->receiverId;
    }
    public function setReceiverId($v)
    {
        $this->receiverId = $v;
        return $this;
    }
    public function getContent()
    {
        return $this->content;
    }
    public function setContent($v)
    {
        $this->content = $v;
        return $this;
    }
    public function getSendAt()
    {
        return $this->sendAt;
    }
    public function setSendAt($v)
    {
        $this->sendAt = $v;
        return $this;
    }
    public function isRead()
    {
        return (bool)$this->messageRead;
    }
    public function setRead($v)
    {
        $this->messageRead = (bool)$v;
        return $this;
    }
    public function getSenderPseudo()
    {
        return $this->senderPseudo;
    }
    public function setSenderPseudo($v)
    {
        $this->senderPseudo = $v;
        return $this;
    }
    public function getSenderAvatar()
    {
        return $this->senderAvatar;
    }
    public function setSenderAvatar($v)
    {
        $this->senderAvatar = $v;
        return $this;
    }
}
